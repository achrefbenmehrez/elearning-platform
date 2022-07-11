<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('test_id')
            ->constrained('tests')
            ->cascadeOnDelete();

            $table->longText('result');
            $table->integer('question_number');
            $table->integer('attempt');
            $table->integer('correct');
            $table->integer('wrong');
            $table->decimal('percentage');

            $table->foreignId('user_id')
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
        Schema::dropIfExists('test_results');
    }
}
