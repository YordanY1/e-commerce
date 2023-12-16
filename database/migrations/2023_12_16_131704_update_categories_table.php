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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->after('id');
            $table->string('slug', 255)->nullable()->after('name');
            $table->string('code', 255)->nullable()->after('slug');
            $table->integer('parent_id')->unsigned()->nullable()->after('code');
            $table->integer('sort_order')->unsigned()->nullable()->after('parent_id');
            $table->text('description')->nullable()->after('sort_order');
            $table->text('keywords')->nullable()->after('description');
            $table->tinyInteger('status')->unsigned()->nullable()->after('keywords');
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
