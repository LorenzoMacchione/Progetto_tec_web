<?php

namespace App\Http\Controllers;

use App\Models\Event_model;
use App\Models\Ticket_model;
use App\Models\Partecipant_model;
use App\Models\Resources\Partecipant;
use App\Models\Resources\Ticket;
use Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\BuyTicketRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Controller2 extends Controller {

    //Proprietà private del Controller che fungeranno da model
    protected $event_model;
    protected $ticket_model;
    protected $partecipant_model;

    //Costruttore del Controller che inizializza le proprietà privata
    public function __construct() {
        $this->event_model = new Event_model;
        $this->ticket_model = new Ticket_model;
        $this->partecipant_model = new Partecipant_model;
        //$this->middleware('auth');
    }

    //Restituisce la pagina del profilo dell'utente
    public function showProfile() {
        $id = Auth::user()->id;
        $tickets = $this->ticket_model->getUserTickets($id)->sortByDesc('dataAcquisto');
        $partecipants = $this->partecipant_model->getUserPartecipant($id);
        return view('profilo')
                        ->with('parteciperò', $partecipants)
                        ->with('biglietti', $tickets);
    }

    //Restituisce la pagina dove si può modificare il profilo dell'utente
    public function showModificaProfilo() {
        $utente = Auth::user();
        return view('modifica_profilo')
                        ->with('utente', $utente)
                        ->with('lv', 2);
    }

    //Modifica il profilo dell'utente attraverso i dati passati
    public function modificaProfilo(UpdateProfileRequest $request) {
        $utente = Auth::user();

        if ($request->nome != null) {
            $utente->update([
                'nome' => $request->nome,
            ]);
        }
        if ($request->password != null) {
            $utente->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect(route('profilo'));
    }

    //Effettua l'acquisto di uno o più biglietti per un determinato concerto
    public function acquistaBiglietto(BuyTicketRequest $request, int $eventId) {
        $id = Auth::user()->id;
        $evento = $this->event_model->findEvent($eventId);
        $biglietti_totali = $evento->biglTot;
        $biglietti_venduti = $this->ticket_model->getTicketsAlreadySoldForEvent($evento->eventId);
        $data_acquisto = date("Y-m-d");

        //Richiesti più biglietti di quelli rimasti da vendere
        if (($biglietti_totali - $biglietti_venduti) < $request->biglietti) {
            return view('riepilogo')
                            ->with('disponibili', $biglietti_totali - $biglietti_venduti)
                            ->with('eventId', $evento->eventId);
        }

        //Richiesti dei biglietti per un concerto scaduto 
        if ($data_acquisto > $evento->data) {
            return view('riepilogo')
                            ->with('data', $evento->data)
                            ->with('eventId', $evento->eventId);
        }

        //Successo (primo caso: scontato, secondo caso: non scontato)
        if (($data_acquisto >= $evento->inizioSconto) && ($evento->inizioSconto != null)) {
            for ($i = 0; $i < $request->biglietti; $i++) {
                $ticket = new Ticket;
                $ticket->titolo = $evento->titolo;
                $ticket->prezzo = $evento->prezzoScontato;
                $ticket->dataAcquisto = $data_acquisto;
                $ticket->metodoPagamento = $request->metodo_pagamento;
                $ticket->acquirente = $id;
                $ticket->evento = $evento->eventId;
                $ticket->save();
                $this->event_model->updateNotorietà($eventId, 3);
            }
            return view('riepilogo')
                            ->with('evento', $ticket->titolo)
                            ->with('prezzo', $ticket->prezzo)
                            ->with('biglietti', $request->biglietti)
                            ->with('utente', Auth::user()->nome)
                            ->with('metodo_pagamento', $request->metodo_pagamento)
                            ->with('data_acquisto', $data_acquisto);
        } else {
            for ($i = 0; $i < $request->biglietti; $i++) {
                $ticket = new Ticket;
                $ticket->titolo = $evento->titolo;
                $ticket->prezzo = $evento->prezzo;
                $ticket->dataAcquisto = $data_acquisto;
                $ticket->metodoPagamento = $request->metodo_pagamento;
                $ticket->acquirente = $id;
                $ticket->evento = $evento->eventId;
                $ticket->save();
                $this->event_model->updateNotorietà($eventId, 3);
            }
            return view('riepilogo')
                            ->with('evento', $ticket->titolo)
                            ->with('prezzo', $ticket->prezzo)
                            ->with('biglietti', $request->biglietti)
                            ->with('utente', Auth::user()->nome)
                            ->with('metodo_pagamento', $request->metodo_pagamento)
                            ->with('data_acquisto', $data_acquisto);
        }
    }

    //Metodo richiamato quando si esprime l'intenzione di partecipare a un determinato concerto
    public function partecipaEvento(int $eventId) {
        $id = Auth::user()->id;
        $evento = $this->event_model->findEvent($eventId);
        $data_odierna = date("Y-m-d");
        $ripetuto = $this->partecipant_model->checkIfAlreadyPartecipate($id, $eventId);

        //Il concerto è già terminato 
        if ($data_odierna > $evento->data) {
            return back()->with('response', 'L\'evento è già terminato!');
        }

        //Crea il parteciperò se non esiste, altrimenti lo cancella
        if ($ripetuto == true) {
            $partecipante = $this->partecipant_model->deletePartecipant($id, $eventId);
            $this->event_model->updateNotorietà($eventId, -1);
            return back();
        } else {
            $partecipante = new Partecipant;
            $partecipante->partecipante = $id;
            $partecipante->evento = $eventId;
            $partecipante->save();
            $this->event_model->updateNotorietà($eventId, +1);
            return back();
        }
    }

}
