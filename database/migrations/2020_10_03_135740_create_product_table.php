<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->string('article');
            $table->foreignId('category_id')->references('id')->on('caterory')->onDelete('cascade');
            $table->string('url');
            $table->string('image_url');
            $table->text('description');
            $table->integer('price');

            $table->string('html_h1')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();

            $table->string('sticker')->nullable();
            $table->string('sticker_position')->nullable();

            $table->integer('sort_order');
            $table->boolean('is_booked');
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
