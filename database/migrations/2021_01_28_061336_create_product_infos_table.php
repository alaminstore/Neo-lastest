<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_infos', function (Blueprint $table) {
            $table->bigIncrements('product_info_id');
            $table->double('price',10,2);
            $table->double('sales_price',10,2)->nullable();
            $table->double('percent',10,2)->nullable();
            $table->bigInteger('product_item_id');
            $table->bigInteger('product_weight_id')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('sku')->nullable();
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
        Schema::dropIfExists('product_infos');
    }
}
