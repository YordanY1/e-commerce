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
        Schema::table('reviews', function (Blueprint $table) {
            // Ensure to only run this line if the user_id column doesn't already exist
            // $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // If the column already exists and you need to make it nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Change back to not nullable if needed, or drop if it was added in this migration
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
