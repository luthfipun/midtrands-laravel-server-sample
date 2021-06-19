<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_time')->nullable(true);
            $table->string('transaction_status')->nullable(true);
            $table->string('transaction_id')->nullable(true);
            $table->string('status_message')->nullable(true);
            $table->string('status_code')->nullable(true);
            $table->string('signature_key')->nullable(true);
            $table->string('payment_type')->nullable(true);
            $table->string('order_id')->nullable(true);
            $table->string('merchant_id')->nullable(true);
            $table->string('masked_card')->nullable(true);
            $table->string('gross_amount')->nullable(true);
            $table->string('fraud_status')->nullable(true);
            $table->string('currency')->nullable(true);
            $table->string('channel_response_message')->nullable(true);
            $table->string('channel_response_code')->nullable(true);
            $table->string('card_type')->nullable(true);
            $table->string('bank')->nullable(true);
            $table->string('approval_code')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
