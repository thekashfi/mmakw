<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwc_manufacturers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name_en',100)->nullable();
			$table->string('name_ar',100)->nullable();
			$table->longText('details_en')->nullable();
			$table->longText('details_ar')->nullable();
			$table->string('image')->nullable();
			$table->integer('display_order')->default(0);
			$table->boolean('is_active')->default(0);
            $table->timestamps('created_at')->useCurrent();
			$table->timestamps('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gwc_manufacturers');
    }
}
