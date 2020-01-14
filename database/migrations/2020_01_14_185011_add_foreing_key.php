<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('employees', function (Blueprint $table) {
      $table->bigInteger('company_id')->unsigned();
      $table->foreign('company_id', 'foreingCompany') //relationPostCategory
            -> references('id')
            -> on('companies');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

      Schema::table('employees', function (Blueprint $table) {
      $table -> dropForeign('foreingCompany');
      $table -> dropColumn('company_id');
    });


    }
}
