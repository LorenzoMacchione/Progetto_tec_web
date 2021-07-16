<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Event;

class Event_model extends Model {

    //Funzione che prende gli eventi più popolari ancora non terminati
    public function getMostPopulars() {
        //Ordina gli eventi dal più popolare al meno popolare
        $events = Event::whereDate('data', '>=', now()->toDateString())->get();
        $ordered = $events->sortByDesc('notorietà');

        //Prende i 4 più popolari e li restituisce
        $most_populars = $ordered->take(4);
        return $most_populars;
    }

    //Funzione che prende gli eventi in sconto ancora non terminati
    public function getDiscounted() {
        $events = Event::whereDate('data', '>=', now()->toDateString())->get();
        $discounted = $events->where('inizioSconto', '<=', now()->toDateString())
                ->where('inizioSconto', '!=', null)
                ->take(4);

        return $discounted;
    }

    //Funzione che restituisce tutti gli eventi
    public function getEvents() {
        $events = Event::get();
        return $events;
    }
    //Funzione che restituisce un singolo evento
    public function findEvent($eventId){
        return Event::find($eventId);
    }

    //Funzione che restituisce un evento
    public function getEventQueryById($eventId){
        return Event::where('eventId', '=', $eventId);
    }

    public function getFilteredEvents($descrizione, $data, $regione, $società) {
        $events = Event::join("users", "events.gestore", "=", "users.id");

        //Li filtra per mese
        if ($data != null) {
            $data = explode('-', $data);
            error_log($data[0]);
            error_log($data[1]);
            $events = $events
                    ->whereMonth('data', $data[1])
                    ->whereYear('data', $data[0]);
        }

        //Li filtra per descrizione
        if ($descrizione != null) {
            $events = $events->where('descrizione', 'LIKE', '%' . $descrizione . '%');
        }

        //Li filtra per regione
        if ($regione != null) {
            $events = $events->where('regione', $regione);
        }
        //Li filtra per società
        if ($società != null) {
            //$id_società = \DB::table('users')->where('nome', $società)->value('id');
            $events = $events->where('nome', $società);
        }

        $events = $events->where('data', '>=', now()->toDateString())->paginate(3);
        return $events;
    }

    //Restituisce gli eventi di una determinata società (con i biglietti totali venduti e gli incassi)
    public function getEventsBySociety(int $id) {
        $events = Event::select(['events.*', \DB::raw('(SELECT COUNT(*) FROM tickets WHERE tickets.evento = events.eventId) as ticket_count'), \DB::raw('(SELECT SUM(tickets.prezzo) FROM tickets WHERE tickets.evento = events.eventId) as ticket_incasso')])
                        ->where('gestore', '=', $id)->get();
        return $events;
    }

    //Aggiorna la notorietà di un evento
    public function updateNotorietà($eventId, $notorietà){
        Event::where('eventId', $eventId)->update(['notorietà' => Event::where('eventId', $eventId)->value('notorietà') + 3,]);
    }

}
