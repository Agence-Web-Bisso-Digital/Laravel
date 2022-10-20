<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisExpresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis_expres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_d')
            ->constrained('partenaires')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('date_depart');
            $table->string('heure_depart');
            $table->foreignId('agence_r')
            ->constrained('partenaires')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('date_retour');
            $table->string('heure_retour');

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
        Schema::dropIfExists('devis_expres');
    }
}
