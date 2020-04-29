<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkout_id')->unsigned();
            $table->foreign('checkout_id')->references('id')->on('tbl_checkout');
            $table->integer('customers_id')->unsigned();
            $table->foreign('customers_id')->references('id')->on('tbl_customers');
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('tbl_payment');
            $table->string('total');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_order');
    }
}
