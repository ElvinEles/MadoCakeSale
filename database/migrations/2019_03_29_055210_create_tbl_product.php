<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('product_id');
            $table->string('product_recieve_person');
            $table->dateTime('product_recieve_date');
            $table->string('product_custom_name');
            $table->string('product_price');
            $table->string('product_kind');
            $table->string('product_size');
            $table->string('product_cake_pors');
            $table->text('product_description');
            $table->string('product_section_name');
            $table->dateTime('product_accept_date');
            $table->string('product_custom_number');
            $table->string('product_advance');
            $table->string('product_kind_other');
            $table->string('product_amount');
            $table->string('product_photo');
            $table->bigInteger('product_recieved')->default('0');
            $table->bigInteger('product_achieve')->default('0');
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
