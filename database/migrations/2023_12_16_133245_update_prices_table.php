<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->nullable()->after('id');
            $table->integer('currency_id')->unsigned()->nullable()->after('product_id');
            $table->decimal('price', 10, 2)->nullable()->after('currency_id');
            $table->decimal('old_price', 10, 2)->nullable()->after('price');
            $table->decimal('cost', 10, 2)->nullable()->after('old_price');
            $table->decimal('margin', 10, 2)->nullable()->after('cost');
            $table->decimal('margin_percent', 10, 2)->nullable()->after('margin');
            $table->decimal('tax', 10, 2)->nullable()->after('margin_percent');
            $table->decimal('tax_percent', 10, 2)->nullable()->after('tax');
            $table->decimal('profit', 10, 2)->nullable()->after('tax_percent');
            $table->decimal('profit_percent', 10, 2)->nullable()->after('profit');
            $table->decimal('discount', 10, 2)->nullable()->after('profit_percent');
            $table->decimal('discount_percent', 10, 2)->nullable()->after('discount');
            $table->decimal('special_price', 10, 2)->nullable()->after('discount_percent');
            $table->decimal('special_price_percent', 10, 2)->nullable()->after('special_price');
            $table->decimal('special_price_start', 10, 2)->nullable()->after('special_price_percent');
            $table->decimal('special_price_end', 10, 2)->nullable()->after('special_price_start');
            $table->tinyInteger('status')->unsigned()->nullable()->after('special_price_end');
            $table->integer('sort_order')->unsigned()->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
