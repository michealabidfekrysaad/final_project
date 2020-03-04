<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_validation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('founder_id')->nullable();
            $table->unsignedBigInteger('lost_id')->nullable();
            $table->text('description');
            $table->enum('status', [-1, 0, 1]);
            $table->foreign('founder_id')->references('id')->on('users')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('lost_id')->references('id')->on('users')
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
        Schema::dropIfExists('description_validation');
    }
}
