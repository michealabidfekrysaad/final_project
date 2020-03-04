<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_item_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->unsignedBigInteger('value_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attributes')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('value_id')->references('id')->on('values_of_attributes')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('_item_attribute_values');
    }
}
