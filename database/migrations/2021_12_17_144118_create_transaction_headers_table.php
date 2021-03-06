<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('card_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_country')->nullable();
            $table->integer('expired_month')->nullable();
            $table->integer('expired_year')->nullable();
            $table->integer('cvc')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('checkout_status')->default('cart');
            $table->double('total_price')->default(0);
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
        Schema::dropIfExists('transaction_headers');
    }
}
