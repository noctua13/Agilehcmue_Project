<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdercontentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordercontents', function (Blueprint $table) {
            $table->id();
			$table->integer('orderid');
			$table->integer('productid');
			$table->integer('quantity');
			$table->integer('price');
			$table->integer('size');
			$table->integer('customizable');
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
        Schema::dropIfExists('ordercontents');
    }
}
