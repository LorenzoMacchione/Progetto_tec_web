<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\User;

class User_model extends Model {
    
    //Funzione che prende la società che si chiama in un certo modo
    public function getSocietàByName($name) {
        $user = User::where("name", $name)
        ->where("livello", "società");
        return $user;
    }
    
    //Funzione che restituisce le società
    public function getSocieties() {
        $societies = User::where('livello', '=', 'società')->get();
        return $societies;
    }
    
    //Funzione che restituisce tutti gli utenti (eccetto l'amministratore)
    public function getAllUsers() {
        $users = User::where('livello', '!=', 'amministratore')->get()->sortByDesc('livello');
        return $users;
    }
    
    //Funzione che restituisce l'utente con un determinato id
    public function getUserById(int $id) {
        $user = User::where('id', $id);
        return $user;
    }

    //Funzione che restituisce il nome di una società dato il suo id
    public function getSocietàName($eventId){
        return User::where('id', $eventId)->value('nome');
    }

}
