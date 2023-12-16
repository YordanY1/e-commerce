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
        Schema::table('countries', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('slug', 255)->nullable()->after('name');
            $table->string('code', 255)->nullable()->after('slug');
            $table->tinyInteger('status')->unsigned()->nullable()->after('code');
            $table->tinyInteger('is_eu')->unsigned()->nullable()->after('status');
            $table->double('vat', 8, 2)->unsigned()->nullable()->after('is_eu');
            $table->integer('sort_order')->unsigned()->nullable()->after('vat');
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
