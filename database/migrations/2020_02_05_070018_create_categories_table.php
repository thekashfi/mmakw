<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwc_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name_en',100)->nullable();
			$table->string('name_ar',100)->nullable();
			$table->longText('details_en')->nullable();
			$table->longText('details_ar')->nullable();
			$table->string('image')->nullable();
			//seo			
			$table->longText('seo_keywords_en')->nullable();
			$table->longText('seo_keywords_ar')->nullable();
			$table->longText('seo_description_ar')->nullable();
			$table->longText('seo_description_en')->nullable();
			$table->text('friendly_url',250)->nullable();
			$table->integer('display_order')->default(0);
			$table->boolean('is_active')->default(0);
			$table->integer('parent_id')->unsigned()->nullable();
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
        Schema::dropIfExists('gwc_categories');
    }
}
