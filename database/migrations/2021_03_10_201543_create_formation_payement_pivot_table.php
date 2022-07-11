<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormationPayementPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_payement', function (Blueprint $table) {
            $table->unsignedBigInteger('formation_id')->index();
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->unsignedBigInteger('payement_id')->index();
            $table->foreign('payement_id')->references('id')->on('payements')->onDelete('cascade');
            $table->primary(['formation_id', 'payement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formation_payement');
    }
}
