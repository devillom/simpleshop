<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCategoriesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('shop_categories', function(Blueprint $table) {
      $table->string('name', 255);
      $table->string('slug')->unique();
      $table->text('content');
      $table->increments('id');
      $table->unsignedInteger('_lft');
      $table->unsignedInteger('_rgt');
      $table->unsignedInteger('parent_id')->nullable();
      $table->index([ '_lft', '_rgt', 'parent_id' ]);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('shop_categories');
  }

}
