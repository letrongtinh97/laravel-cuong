<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatTblTotalProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_total_product_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('tbl_product');

            $table->integer('size_details_id')->unsigned();
            $table->foreign('size_details_id')->references('id')->on('tbl_size_details');

            $table->integer('color_details_id')->unsigned();
            $table->foreign('color_details_id')->references('id')->on('tbl_color_details');

            $table->string('total')->default(0);
            $table->string('old')->default(0);
            $table->string('new')->default(0);
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
        Schema::dropIfExists('tbl_total_product_details');
    }
}
