<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Partecipant;

class Partecipant_model extends Model {

    //Funzione che prende gli eventi a cui parteciperà un utente
    public function getUserPartecipant($id) {
        $events = Partecipant::join("users", "partecipants.partecipante", "=", "users.id")
                ->join("events", "partecipants.evento", "=", "events.eventId")
                ->where("users.id", "=", $id)
                ->get();

        //Li ordina per data
        return $events->sortBy('data');
    }

    //Ritorna il numero di perteciperò per un dato evento
    public function getNumberPartecipantsOfEvent($eventId){
        return Partecipant::where('evento', $eventId)->count();
    }

    //Funzione che verifica se un utente già ha espresso l'intenzione di partecipare a un evento
    public function checkIfAlreadyPartecipate(int $id, int $eventId) {
        $partecipants = Partecipant::where("partecipante", "=", $id)
                ->where("evento", "=", $eventId)
                ->count();

        if ($partecipants == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Funzione che cancella un parteciperò preciso
    public function deletePartecipant(int $id, int $eventId) {
        $partecipant = Partecipant::where("partecipante", "=", $id)
                ->where("evento", "=", $eventId)
                ->delete();
    }

}
