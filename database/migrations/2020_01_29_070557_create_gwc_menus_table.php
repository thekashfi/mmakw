<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGwcMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwc_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('mobile');
			$table->string('link');
			$table->string('icon');
            $table->string('parent_id');
            $table->string('display_order');
			$table->integer('is_active');
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
        Schema::dropIfExists('gwc_menus');
    }
}
