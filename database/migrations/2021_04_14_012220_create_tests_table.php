<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('formation_id')
            ->constrained('formations')
            ->cascadeOnDelete();

            $table->foreignId('chapitre_id')
            ->constrained('chapitres')
            ->unique()
            ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('published')->nullable()->default(0);

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
        Schema::dropIfExists('tests');
    }
}
