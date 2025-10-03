<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('invoice_types'))
        {
            Schema::create('invoice_types', function (Blueprint $table)
            {
                $table->tinyIncrements('id');
                $table->string('name');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('enterprises') && Schema::hasColumn('enterprises', 'invoice_type_id'))
        {
            Schema::table('enterprises', function (Blueprint $table)
            {
                try {
                    $table->foreign('invoice_type_id')
                        ->references('id')
                        ->on('invoice_types')
                        ->onDelete('cascade');
                } catch (\Throwable $e) {
                    // ignore if already exists
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('enterprises'))
        {
            Schema::table('enterprises', function (Blueprint $table)
            {
                try {
                    $table->dropForeign('enterprises_invoice_type_id_foreign');
                } catch (\Throwable $e) {
                    // ignore
                }
            });
        }

        Schema::dropIfExists('invoice_types');
    }
};


