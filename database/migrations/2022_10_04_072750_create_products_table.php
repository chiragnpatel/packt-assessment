<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->nullable();
            $table->string('isbn13')->nullable();
            $table->string('title')->nullable();
            $table->date('publication_date')->nullable();
            $table->tinyInteger('product_type')->nullable();
            $table->json('authors')->nullable();
            $table->json('categories')->nullable();
            $table->string('concept')->nullable();
            $table->string('language')->nullable();
            $table->string('language_version')->nullable();
            $table->string('tool')->nullable();
            $table->string('vendor')->nullable();
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
        Schema::dropIfExists('products');
    }
}
