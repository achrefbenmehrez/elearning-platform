<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartes', function (Blueprint $table) {
            $table->id();
            $table->string('Nom_du_titulaire_de_la_carte');
            $table->integer('Numero_de_la_carte');
            $table->string("date_expiration");
            $table->integer('CVV');
            $table->float('Solde_de_la_carte');

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnDelete();

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
        Schema::dropIfExists('cartes');
    }
}
