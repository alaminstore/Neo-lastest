<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->bigIncrements('product_item_id');
            $table->unsignedBigInteger('product_sub_category_id');
            $table->string('product_item_name');
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->longText('product_item_description')->nullable();
            $table->tinyInteger('new_arrival')->default(0);
            $table->tinyInteger('popular')->default(0);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('product_items');
    }
}
