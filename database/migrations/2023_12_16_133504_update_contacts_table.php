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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('email', 255)->nullable()->after('name');
            $table->string('phone', 255)->nullable()->after('email');
            $table->text('message')->nullable()->after('phone');
            $table->tinyInteger('status')->unsigned()->nullable()->after('message');
            $table->tinyInteger('type')->unsigned()->nullable()->after('status');
            $table->integer('sort_order')->unsigned()->nullable()->after('type');
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
