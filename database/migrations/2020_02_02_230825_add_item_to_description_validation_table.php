<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemToDescriptionValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('description_validation', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->after("lost_id")->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('description_validation', function (Blueprint $table) {
            //
        });
    }
}
