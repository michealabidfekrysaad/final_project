<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('age');
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->enum('type', ['found', 'lost']);
            $table->string('special_mark')->nullable();
            $table->enum('eye_color', ['black', 'brown', 'green', 'grey', 'blue']);
            $table->enum('hair_color', ['black', 'brown', 'white', 'golden'])->nullable();
            $table->string('location');
            $table->string('last_seen_on')->nullable();
            $table->string('last_seen_at')->nullable();
            $table->date('lost_since')->nullable();
            $table->date('found_since')->nullable();
            $table->enum('is_found', [0, 1])->default(0);
            $table->float('height')->max(250);
            $table->float('weight')->max(250);
            $table->unsignedBigInteger('user_id')->nullable()
                ->onUpdate('cascade')->onDelete('set null');;
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reports');
    }
}
