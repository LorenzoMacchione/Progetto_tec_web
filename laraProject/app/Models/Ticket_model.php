<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Ticket;

class Ticket_model extends Model {

    //Restituisce i biglietti di un determinato utente
    public function getUserTickets($id) {
        $events = Ticket::where('acquirente', '=', $id)->get();
        
        //Li ordina per data d'acquisto
        return $events->sortBy('dataAcquisto');
    }
    
    //Restituisce i biglietti già venduti per un evento
    public function getTicketsAlreadySoldForEvent($eventId) {
        $tickets = Ticket::where("evento", "=", $eventId)->get()->count();
        return $tickets;   
    }

    //Aggiorna i titoli dei biglietti al cambio del nome dell'evento
    public function updateTicketsTitleByEventId($eventId, $newTitle){
        Ticket::where('evento', '=', $eventId)->update([
            'titolo' => $newTitle,
        ]);
    }

}
