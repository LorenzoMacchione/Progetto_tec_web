<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //Crea la tabella degli utenti
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('username', 20)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nome', 30);
            $table->string('password');
            $table->enum('livello', ['utente', 'società', 'amministratore'])->default('utente');
            $table->rememberToken();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
