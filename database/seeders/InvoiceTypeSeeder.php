<?php

namespace Idoneo\HumanoBilling\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InvoiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('invoice_types')) {
            return;
        }

        $types = [
            ['id' => 1, 'name' => 'Invoice', 'is_active' => true],
            ['id' => 2, 'name' => 'Credit Note', 'is_active' => true],
            ['id' => 3, 'name' => 'Debit Note', 'is_active' => true],
        ];

        foreach ($types as $type) {
            DB::table('invoice_types')->updateOrInsert(
                ['id' => $type['id']],
                ['name' => $type['name'], 'is_active' => $type['is_active']]
            );
        }
    }
}


