<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_designs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            
            $table->unsignedBigInteger('design_id');
            $table->unsignedBigInteger('company_id');
            $table->string('image');
            $table->string('link');

            $table->foreign('design_id')->references('id')->on('designs');
            $table->foreign('company_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_designs');
    }
}
