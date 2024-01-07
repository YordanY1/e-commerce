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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('stripe_payment_intent_id', 255)->nullable()->after('id');
            $table->string('stripe_payment_method_id', 255)->nullable()->after('stripe_payment_intent_id');
            $table->string('stripe_client_id', 255)->nullable()->after('stripe_payment_method_id');
            $table->double('amount', 10, 2)->nullable()->after('stripe_client_id');
            $table->double('vat_amount', 10, 2)->nullable()->after('amount');
            $table->double('total_amount', 10, 2)->nullable()->after('vat_amount');
            $table->string('currency', 255)->nullable()->after('total_amount');
            $table->bigInteger('currency_id')->unsigned()->nullable()->after('currency');
            $table->tinyInteger('status')->unsigned()->nullable()->after('currency_id');
            $table->bigInteger('user_id')->unsigned()->nullable()->after('status');
            $table->string('session_id', 255)->nullable()->after('user_id');
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
