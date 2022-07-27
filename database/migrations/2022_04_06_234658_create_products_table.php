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
            $table->id();
            $table->string('name', 255);
            $table->text('info');
            $table->unsignedInteger('price');
            $table->boolean('is_selling');
            $table->foreignId('category_id')
            ->constrained();
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();;
            $table->string('image3', 255)->nullable();;
            $table->string('image4', 255)->nullable();;
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
        Schema::dropIfExists('products');
    }
}
