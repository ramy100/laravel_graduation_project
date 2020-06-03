<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignerRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('likes');
            $table->unsignedBigInteger('designer_id');
            $table->unsignedBigInteger('liker_id');


            $table->foreign('liker_id')->references('id')->on('users');
            $table->foreign('designer_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designer_rates');
    }
}
