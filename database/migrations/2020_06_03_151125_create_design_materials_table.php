<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_materials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->unsignedBigInteger('design_id');
            $table->unsignedBigInteger('material_id');


            $table->foreign('design_id')->references('id')->on('designs');
            $table->foreign('material_id')->references('id')->on('materials');
            // $table->primary(['design_id', 'material_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_materials');
    }
}
