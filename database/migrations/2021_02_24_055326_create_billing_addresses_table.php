<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->bigIncrements('billing_address_id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('house_and_street')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('billing_addresses');
    }
}
