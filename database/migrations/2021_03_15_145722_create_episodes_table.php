<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('description');
            $table->string('video_url');
            $table->integer('numero');

            $table->foreignId('formation_id')
            ->constrained('formations')
            ->cascadeOnDelete();

            $table->foreignId('chapitre_id')
            ->constrained('chapitres')
            ->cascadeOnDelete();

            $table->unique(['numero', 'formation_id']);

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
        Schema::dropIfExists('videos');
    }
}
