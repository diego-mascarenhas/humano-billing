<?php

namespace Idoneo\HumanoBilling\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('payment_types')) {
            return;
        }

        $paymentTypes = [
            ['id' => 1, 'name' => 'Cash', 'is_active' => true],
            ['id' => 2, 'name' => 'Bank Transfer', 'is_active' => true],
            ['id' => 3, 'name' => 'Bank Deposit', 'is_active' => true],
            ['id' => 4, 'name' => 'Check', 'is_active' => true],
            ['id' => 5, 'name' => 'Debit', 'is_active' => true],
            ['id' => 6, 'name' => 'Credit Card', 'is_active' => true],
            ['id' => 7, 'name' => 'PayPal', 'is_active' => true],
            ['id' => 8, 'name' => 'Stripe', 'is_active' => true],
            ['id' => 9, 'name' => 'Wise Transfer', 'is_active' => true],
            ['id' => 10, 'name' => 'Cryptocurrency', 'is_active' => true],
            ['id' => 11, 'name' => 'Bizum', 'is_active' => true],
        ];

        foreach ($paymentTypes as $type) {
            DB::table('payment_types')->updateOrInsert(
                ['id' => $type['id']],
                ['name' => $type['name'], 'is_active' => $type['is_active']]
            );
        }
    }
}


