<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGwcSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwc_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('keyname',10)->default('setting');
			$table->string('name_en',150)->nullable();
			$table->string('name_ar',150)->nullable();
			$table->longText('seo_description_en')->nullable();
			$table->longText('seo_description_ar')->nullable();
			$table->longText('seo_keywords_en')->nullable();
			$table->longText('seo_keywords_ar')->nullable();
			$table->string('owner_name',150)->nullable();
			$table->longText('address_en')->nullable();
			$table->longText('address_ar')->nullable();
			$table->string('email',150)->nullable();
			$table->string('phone',50)->nullable();
			$table->string('mobile',50)->nullable();
			$table->string('logo',100)->nullable();
			$table->string('emaillogo',100)->nullable();
			$table->string('favicon',100)->nullable();
			$table->integer('item_per_page_front')->default(50);
			$table->integer('item_per_page_back')->default(50);
			$table->integer('bestseller_items')->default(10);
			$table->integer('featured_items')->default(10);
			$table->integer('latest_items')->default(10);
			$table->integer('special_items')->default(10);
			$table->integer('items_of_the_day')->default(10);
			$table->string('base_currency',10)->default('KD');
			$table->integer('default_sort')->default(0);//0 = id , 1 = name , 2 = date
			$table->boolean('is_watermark')->default('0');
			$table->string('watermark_img')->nullable();
			$table->integer('category_thumb_w')->default(100);
			$table->integer('category_thumb_h')->default(100);
			$table->integer('category_big_w')->default(500);
			$table->integer('category_big_h')->default(500);
			$table->integer('product_thumb_w')->default(100);
			$table->integer('product_thumb_h')->default(100);
			$table->integer('product_big_w')->default(500);
			$table->integer('product_big_h')->default(500);
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
        Schema::dropIfExists('gwc_settings');
    }
}
