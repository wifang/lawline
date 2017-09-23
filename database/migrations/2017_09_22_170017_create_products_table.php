<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id'); 
			$table->integer('user_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->string('image');
            $table->timestamps();
			
			//foreign key
			$table->integer('user_id')->index();
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
