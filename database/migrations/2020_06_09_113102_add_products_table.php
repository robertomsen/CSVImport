<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function($table)
        {            
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name', 50);
            $table->string('description', 150);
            $table->float('price');
            $table->integer('stock');
            $table->dateTime('date_last_sale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
