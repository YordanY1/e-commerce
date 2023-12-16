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
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('slug', 255)->nullable()->after('name');
            $table->string('code', 255)->nullable()->after('slug');
            $table->integer('country_id')->unsigned()->nullable()->after('code');
            $table->tinyInteger('status')->unsigned()->nullable()->after('country_id');
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
