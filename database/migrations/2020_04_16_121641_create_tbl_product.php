<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('tbl_category_product');
            
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('tbl_brand');
            
            $table->text('description');
            $table->text('content');
            $table->string('unit_price');
            $table->string('sale_price');
            $table->string('image');
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
        Schema::dropIfExists('tbl_product');
    }
}
