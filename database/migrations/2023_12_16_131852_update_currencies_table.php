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
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('code', 255)->nullable()->after('name');
            $table->string('symbol', 255)->nullable()->after('code');
            $table->integer('country_id')->unsigned()->nullable()->after('symbol');
            $table->tinyInteger('status')->unsigned()->nullable()->after('country_id');
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
