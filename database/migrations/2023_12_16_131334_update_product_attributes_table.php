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
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->nullable()->after('id');
            $table->string('size', 255)->nullable()->after('product_id');
            $table->string('weight', 255)->nullable()->after('size');
            $table->string('color', 255)->nullable()->after('weight');
            $table->text('description')->nullable()->after('color');
            $table->text('categories')->nullable()->after('description');
            $table->text('keywords')->nullable()->after('categories');
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
