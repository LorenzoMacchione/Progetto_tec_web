<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //Crea la tabella dei biglietti
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('ticketId');
            $table->string('titolo', 25);
            $table->double('prezzo', 5, 2);
            $table->date('dataAcquisto');
            $table->enum('metodoPagamento', ['bonifico', 'paypal', 'carta']);
            $table->bigInteger('acquirente')->unsigned()->index()->nullable();
            $table->foreign('acquirente')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger('evento')->unsigned()->index()->nullable();
            $table->foreign('evento')->references('eventId')->on('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tickets');
    }

}
