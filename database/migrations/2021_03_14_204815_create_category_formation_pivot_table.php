<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryFormationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_formation', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_id')->index();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('formation_id')->index();
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->primary(['categorie_id', 'formation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_formation');
    }
}
