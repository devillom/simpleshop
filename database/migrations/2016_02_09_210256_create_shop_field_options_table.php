<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopFieldOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_field_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->text('content')->nullable();
            $table->integer('field_id')->index();
            $table->integer('child_field_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shop_field_options');
    }
}
