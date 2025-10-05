<?php

namespace Idoneo\HumanoBilling;

use Idoneo\HumanoBilling\Models\SystemModule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Idoneo\HumanoBilling\Database\Seeders\PaymentTypeSeeder;
use Idoneo\HumanoBilling\Database\Seeders\InvoiceTypeSeeder;

class HumanoBillingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('humano-billing')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasMigrations([
                '2024_03_01_000000_create_payment_types_table',
                '2024_03_01_000001_create_invoice_types_table',
            ]);
    }

    /**
     * Note: Billing is NOT registered as a module because it's a group category.
     * Individual modules like 'invoices', 'payments', 'accounting', 'financial', 'earnings', 'expenses'
     * are defined in ModuleSeeder under the 'billing' group.
     */
    public function bootingPackage()
    {
        parent::bootingPackage();

        // Module registration removed - 'billing' is a group, not an individual module

        // Seed defaults if tables exist (idempotent)
        try {
            if (Schema::hasTable('payment_types')) {
                (new PaymentTypeSeeder())->run();
            }
            if (Schema::hasTable('invoice_types')) {
                (new InvoiceTypeSeeder())->run();
            }
        } catch (\Throwable $e) {
            // ignore seeding errors on boot
        }

        // Ensure billing-related permissions exist and are granted to admin
        try {
            if (Schema::hasTable('permissions') && class_exists(\Spatie\Permission\Models\Permission::class)) {
                $billingPermissions = [
                    // invoices
                    'invoice.index','invoice.list','invoice.create','invoice.show','invoice.edit','invoice.store','invoice.update','invoice.destroy',
                    // payments
                    'payment.index','payment.list','payment.create','payment.show','payment.edit','payment.store','payment.update','payment.destroy',
                    // accounting
                    'accounting.index','accounting.list','accounting.create','accounting.show','accounting.edit','accounting.store','accounting.update','accounting.destroy',
                ];

                foreach ($billingPermissions as $permission) {
                    \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
                }

                // Grant to admin role if exists
                if (class_exists(\Spatie\Permission\Models\Role::class)) {
                    $adminRole = \Spatie\Permission\Models\Role::where('name', 'admin')->first();
                    if ($adminRole) {
                        $created = \Spatie\Permission\Models\Permission::whereIn('name', $billingPermissions)->get();
                        if ($created->isNotEmpty()) {
                            $adminRole->givePermissionTo($created);
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::debug('HumanoBilling: permissions setup skipped: ' . $e->getMessage());
        }
    }
}


