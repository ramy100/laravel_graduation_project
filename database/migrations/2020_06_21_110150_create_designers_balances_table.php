<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignersBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designers_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('designer_id');
            $table->float('balance', 8, 2)->default(0);	
            
            $table->foreign('designer_id')->references('id')->on('users');
            $table->primary('designer_id');
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
        Schema::dropIfExists('designers_balances');
    }
}
