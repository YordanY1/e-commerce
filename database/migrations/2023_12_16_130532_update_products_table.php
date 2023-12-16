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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('slug', 255)->nullable()->after('name');
            $table->string('code', 255)->nullable()->after('slug');
            $table->integer('manufacturer_id')->unsigned()->nullable()->after('code');
            $table->tinyInteger('type')->unsigned()->nullable()->default(1)->after('manufacturer_id');
            $table->tinyInteger('status')->unsigned()->nullable()->default(1)->after('type');
            $table->integer('quantity')->unsigned()->nullable()->default(0)->after('status');
            $table->integer('sort_order')->unsigned()->nullable()->after('quantity');
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
