<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('tbl_order');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('tbl_product');

            $table->integer('size_details_id')->unsigned();
            $table->foreign('size_details_id')->references('id')->on('tbl_size_details');

            $table->integer('size_color_id')->unsigned();
            $table->foreign('size_color_id')->references('id')->on('tbl_color_details');

            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_sale_quantity');
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
        Schema::dropIfExists('tbl_order_details');
    }
}
