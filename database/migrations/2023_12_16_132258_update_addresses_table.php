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
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('slug', 255)->nullable()->after('name');
            $table->string('zip_code', 255)->nullable()->after('slug');
            $table->string('city', 255)->nullable()->after('zip_code');
            $table->string('street', 255)->nullable()->after('city');
            $table->integer('country_id')->unsigned()->nullable()->after('zip_code');
            $table->tinyInteger('type')->unsigned()->nullable()->default(1)->after('country_id');
            $table->tinyInteger('status')->unsigned()->nullable()->default(1)->after('type');
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
