<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations_alt', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer('color');
            $table->integer('shade');
            $table->integer('finish');
            $table->integer('look');
            $table->integer('shape');
            $table->integer('box_size');
            $table->float('width');
            $table->float('length');
            $table->float('price');
            $table->string('sku')->default("");
            $table->integer("media_id")->default(0);
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
        Schema::dropIfExists('product_variations');
    }
}
