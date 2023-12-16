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
        Schema::table('files', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->nullable()->after('id');
            $table->integer('category_id')->unsigned()->nullable()->after('product_id');
            $table->integer('manufacturer_id')->unsigned()->nullable()->after('category_id');
            $table->string('name', 255)->nullable()->after('manufacturer_id');
            $table->string('uploaded_name', 255)->nullable()->after('name');
            $table->string('path', 255)->nullable()->after('uploaded_name');
            $table->string('extension', 255)->nullable()->after('path');
            $table->integer('size')->unsigned()->nullable()->after('extension');
            $table->string('type', 255)->nullable()->after('size');
            $table->string('sort_order', 255)->nullable()->after('type');
            $table->tinyInteger('status')->unsigned()->nullable()->after('sort_order');
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
