<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartecipantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('partecipants', function (Blueprint $table) {
            $table->bigIncrements('partecipantId');
            $table->bigInteger('partecipante')->unsigned()->index();
            $table->foreign('partecipante')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('evento')->unsigned()->index();
            $table->foreign('evento')->references('eventId')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('partecipants');
    }

}
