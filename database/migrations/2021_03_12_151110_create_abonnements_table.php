<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();
            $table->foreignId('type_abonnement_id')
            ->constrained('type_abonnements')
            ->cascadeOnDelete();
            $table->float('montant_paye');
            $table->boolean('active')->default(1);
            $table->dateTime('date_de_fin');
            $table->timestamps();

            $table->foreignId('carte_id')
            ->constrained('cartes')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnements');
    }
}
