<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAndTitleColumnToCompanyDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_designs', function (Blueprint $table) {
            //
            $table->string('title');
            $table->float('price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_designs', function (Blueprint $table) {
            //
            $table->dropColumn('title');
            $table->dropColumn('price');
        });
    }
}
