<?php

namespace App\Http\Controllers;

use App\Models\Event_model;
use App\Models\Ticket_model;
use App\Models\Resources\Event;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Resources\Ticket;
use Auth;

class Controller3 extends Controller {

    //Proprietà private del Controller che fungeranno da model
    protected $event_model;
    protected $ticket_model;

    //Costruttore del Controller che inizializza le proprietà privata
    public function __construct() {
        $this->event_model = new Event_model;
        $this->ticket_model = new Ticket_model;
    }

    //Restituisce la pagina con gli eventi della società
    public function showMieiEventi() {
        $id = Auth::user()->id;
        $events = $this->event_model->getEventsBySociety($id);

        return view('miei_eventi')
                        ->with('eventi', $events);
    }

    //Crea un evento di una determinata società
    public function creaEvento(EventCreateRequest $request) {
        $id = Auth::user()->id;

        if ($request->hasFile('immagine')) {
            $image = $request->file('immagine');
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = null;
        }

        //Crea l'evento
        $event = new Event;
        $event->titolo = $request->titolo;
        $event->descrizione = $request->descrizione;
        //Se è stata specificata l'immagine viene caricata nel server
        if ($imageName != null) {
            $event->immagine = $imageName;
            $destinationPath = public_path() . '/img';
            $image->move($destinationPath, $imageName);
        }
        $event->programma = $request->programma;
        $event->data = $request->data;
        $event->orario = $request->orario;
        $event->regione = $request->regione;
        $event->luogo = $request->luogo;
        $event->lat = $request->latitudine;
        $event->long = $request->longitudine;
        $event->indStrad = $request->indicazioni;
        $event->prezzo = $request->prezzo;
        $event->biglTot = $request->biglietti;
        //Se è stato specificato uno sconto lo mette, altrimenti è null
        if ($request->sconto != null) {
            $prezzoScontato = $request->prezzo * (1 - $request->sconto / 100);
        } else {
            $prezzoScontato = null;
        }
        $event->prezzoScontato = $prezzoScontato;
        //Se è stato specificata la data di sconto la mette, altrimenti è null
        $event->inizioSconto = $request->inizio_sconto;
        $event->notorietà = 0;
        $event->gestore = $id;

        $event->save();

        return redirect('miei_eventi')->with('message', 'Evento creato con successo!');
    }

    //Mostra la form di modifica di un evento precompilata con i dati iniziali
    public function showModificaEvento(int $eventId) {
        $evento = $this->event_model->findEvent($eventId);
        if ($evento != null) {
            $venduti = $this->ticket_model->getTicketsAlreadySoldForEvent($eventId);
            $sconto = null;
            if ($evento->prezzoScontato != null) {
                $sconto = 100 * (1 - ($evento->prezzoScontato / $evento->prezzo));
            }
            if (Auth::user()->id == $evento->gestore) {
                return view('modifica_evento')
                                ->with('evento', $evento)
                                ->with('venduti', $venduti)
                                ->with('sconto', $sconto);
            } else {
                return redirect('miei_eventi')->with('error', 'Non puoi modificare l\'evento di un\'altra società!');
            }
        } else {
            return redirect('miei_eventi')->with('error', 'Non puoi modificare un evento inesistente!');
        }
    }

    //Modifica un evento di una determinata società
    public function modificaEvento(EventUpdateRequest $request) {
        $event = $this->event_model->getEventQueryById($request->eventId);
        if (Auth::user()->id != $event->first()->gestore){
            return abort(403, 'Unauthorized action.');
        }
        $this->ticket_model->updateTicketsTitleByEventId($request->eventId, $request->titolo);

        if ($request->hasFile('immagine')) {
            $image = $request->file('immagine');
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = null;
        }

        //Modifica l'evento
        $event->update([
            'titolo' => $request->titolo,
            'descrizione' => $request->descrizione,
            'programma' => $request->programma,
            'data' => $request->data,
            'orario' => $request->orario,
            'regione' => $request->regione,
            'luogo' => $request->luogo,
            'lat' => $request->latitudine,
            'long' => $request->longitudine,
            'indStrad' => $request->indicazioni,
            'prezzo' => $request->prezzo,
            'biglTot' => $request->biglietti,
        ]);

        //Se è stato specificato uno sconto lo mette, altrimenti è null
        if ($request->sconto != null) {
            $prezzoScontato = $request->prezzo * (1 - $request->sconto / 100);
        } else {
            $prezzoScontato = null;
        }
        $event->update([
            'prezzoScontato' => $prezzoScontato,
            'inizioSconto' => $request->inizio_sconto,
        ]);

        //Se è stata specificata l'immagine viene caricata nel server
        if ($imageName != null) {
            $event->update([
                'immagine' => $imageName,
            ]);
            $destinationPath = public_path() . '/img';
            $image->move($destinationPath, $imageName);
        }

        return redirect('miei_eventi')->with('message', 'Evento modificato con successo!');
    }

    //Cancella un evento di una società
    public function cancellaEvento(int $eventId) {
        $evento = $this->event_model->findEvent($eventId);
        if ($evento != null) {
            if (Auth::user()->id == $evento->gestore) {
                $evento->delete();
                return redirect('miei_eventi')->with('message', 'Evento cancellato con successo!');
            } else {
                return redirect('miei_eventi')->with('error', 'Non puoi cancellare l\'evento di un\'altra società!');
            }
        } else {
            return redirect('miei_eventi')->with('error', 'Non puoi cancellare un evento inesistente!');
        }
    }

}
