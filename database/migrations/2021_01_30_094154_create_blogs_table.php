<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('blog_id');
            $table->unsignedBigInteger('blog_category_id');
            $table->string('blog_header')->nullable();
            $table->string('slug')->nullable();
            $table->string('full_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->longText('description')->nullable();
            $table->date('post_date')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('blogs');
    }
}
