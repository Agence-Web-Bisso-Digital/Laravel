<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_promos', function (Blueprint $table) {
            $table->id();
            $table->string('code_promo');
            $table->foreignId('partenaire_id')
            ->constrained('partenaires')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('client_id')
            ->constrained('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('code_promos');
    }
}
