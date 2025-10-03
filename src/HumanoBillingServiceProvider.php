<?php

namespace Idoneo\HumanoBilling;

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
            ->hasRoute('web');
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        try {
            if (Schema::hasTable('modules')) {
                if (class_exists(\App\Models\Module::class)) {
                    \App\Models\Module::updateOrCreate(
                        ['key' => 'billing'],
                        [
                            'name' => 'Billing',
                            'icon' => 'ti ti-receipt-2',
                            'description' => 'Invoices, payments and payment methods',
                            'is_core' => false,
                            'status' => 1,
                        ]
                    );
                }
            }
        } catch (\Throwable $e) {
            Log::debug('HumanoBilling: bootstrap note: ' . $e->getMessage());
        }

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
    }
}


