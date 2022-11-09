<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwc_users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('userType')->default('admin');
            $table->string('name');
			$table->string('mobile');
			$table->string('image');
			$table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
			$table->integer('is_active');
            $table->rememberToken();
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
        Schema::dropIfExists('gwc_users');
    }
}
