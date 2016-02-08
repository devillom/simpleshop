<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_field_values', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('value_str',255)->nullable();
            $table->integer('value_int')->nullable();
            $table->text('value_text')->nullable();
            $table->date('value_dt')->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('field_id')->unsigned();
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
        Schema::drop('shop_field_values');
    }
}
