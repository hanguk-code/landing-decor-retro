<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeFieldsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_product', function (Blueprint $table) {
            $table->string('upc', 12)->nullable()->change();
            $table->string('jan', 13)->nullable()->change();
            $table->integer('manufacturer_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oc_product', function (Blueprint $table) {
            $table->string('upc', 12)->nullable(false)->change();
            $table->string('jan', 13)->nullable(false)->change();
            $table->integer('manufacturer_id')->nullable(false)->change();
        });
    }
}
