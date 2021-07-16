<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //Crea la tabella degli eventi
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('eventId');
            $table->string('titolo', 25);
            $table->string('descrizione', 300);
            $table->string('immagine', 200)->default('evento.jpg');
            $table->string('programma', 300);
            $table->date('data');
            $table->time('orario', 0);
            $table->string('regione', 25);
            $table->string('luogo', 60);
            $table->double('lat', 10, 7);
            $table->double('long', 10, 7);
            $table->string('indStrad', 500);
            $table->double('prezzo', 5, 2);
            $table->integer('biglTot');
            $table->double('prezzoScontato', 5, 2)->nullable();
            $table->date('inizioSconto')->nullable();
            $table->integer('notorietà');
            $table->bigInteger('gestore')->unsigned()->index();
            $table->foreign('gestore')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('events');
    }

}
