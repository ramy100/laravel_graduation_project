<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('body');

            $table->unsignedBigInteger('design_id');
            $table->unsignedBigInteger('user_id');



            $table->foreign('design_id')->references('id')->on('designs');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->primary(['design_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_comments');
    }
}
