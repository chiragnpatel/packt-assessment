<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->string('isbn13');
            $table->string('isbn10');
            $table->json('isbns');
            $table->string('title');
            $table->tinyInteger('product_type');
            $table->binary('tagline')->nullable();
            $table->integer('pages')->nullable();
            $table->date('publication_date');
            $table->string('length')->nullable();
            $table->binary('learn')->nullable();
            $table->binary('features')->nullable();
            $table->binary('description')->nullable();
            $table->json('authors')->nullable();
            $table->string('url');
            $table->tinyInteger('category');
            $table->json('concept');
            $table->string('expertise')->nullable();
            $table->json('languages');
            $table->json('tools');
            $table->json('jobroles');
            $table->json('vendors');
            $table->json('images');
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
        Schema::dropIfExists('product_detail');
    }
}
