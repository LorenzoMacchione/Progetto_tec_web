<?php

namespace App\Http\Controllers;

use App\Models\Event_model;
use App\Models\Faq_model;
use App\Models\Partecipant_model;
use App\Models\User_model;
use Auth;

class Controller1 extends Controller {

    //Proprietà private del Controller che fungeranno da model
    protected $event_model;
    protected $faq_model;
    protected $partecipant_model;
    protected $user_model;

    //Costruttore del Controller che inizializza le proprietà private
    public function __construct() {
        $this->event_model = new Event_model;
        $this->faq_model = new Faq_model;
        $this->partecipant_model = new Partecipant_model;
        $this->user_model = new User_model;
    }

    //Metodo che richiama la vista corrispondente alla home (passandole gli eventi più popolari e quelli a cui l'utente parteciperà)
    public function showHome() {
        $most_populars = $this->event_model->getMostPopulars();
        $scontati = $this->event_model->getDiscounted();
        $elenco_società = $this->user_model->getSocieties();
        //Prende l'id dell'utente
        $id = \Auth::id();
        //Se l'utente si è autenticato prende anche gli eventi a cui parteciperà altrimenti no
        if ($id != null) {
            $eventi_a_cui_partecipare = $this->partecipant_model->getUserPartecipant($id);
            $eventi_a_cui_partecipare = $eventi_a_cui_partecipare->where('data', '>=', now()->toDateString());
            return view('home')
                            ->with('most_populars', $most_populars)
                            ->with('scontati', $scontati)
                            ->with('eventi', $eventi_a_cui_partecipare)
                            ->with('elenco_società', $elenco_società);
        } else {
            return view('home')
                            ->with('most_populars', $most_populars)
                            ->with('scontati', $scontati)
                            ->with('elenco_società', $elenco_società);
        }
    }

    //Metodo che richiama la vista corrispondente al catalogo
    public function showCatalog() {
        $events = $this->event_model->getEvents();
        return view('catalogo')
                        ->with('events', $events);
    }

    //Metodo che richiama la vista corrispondente al catalogo (passandole gli eventi ricercati)
    public function showCatalog_filtered() {
        //Prende i parametri di ricerca
        $descrizione = request()->input('descrizione', null);
        $mese = request()->input('mese', null);
        $regione = request()->input('regione', null);
        $società = request()->input('società', null);
        $elenco_società = $this->user_model->getSocieties();

        $events = $this->event_model->getFilteredEvents($descrizione, $mese, $regione, $società);

        //Prende tutti gli eventi

        return view('catalogo')
                        ->with('events', $events)
                        ->with('descrizione', $descrizione)
                        ->with('mese', $mese)
                        ->with('regione', $regione)
                        ->with('società', $società)
                        ->with('elenco_società', $elenco_società);
    }

    //Metodo che richiama la vista corrispondente al dettaglio di un evento
    public function showDetails(int $eventId) {
        $event = $this->event_model->findEvent($eventId);
        $partecipanti = $this->partecipant_model->getNumberPartecipantsOfEvent($eventId);
        $nome_società = $this->user_model->getSocietàName($event->gestore);
        $user = Auth::user();
        if ($user != null) {
            $partecipo = $this->partecipant_model->checkIfAlreadyPartecipate($user->id, $eventId);
        } else {
            $partecipo = false;
        }
        return view('dettagli')
                        ->with('evento', $event)
                        ->with('partecipanti', $partecipanti)
                        ->with('nome_societa', $nome_società)
                        ->with('partecipo', $partecipo);
    }

    //Metodo che richiama la vista corrispondente alla pagina delle faq (passandole le faq)
    public function showFaq() {
        $faq = $this->faq_model->getFaq();
        return view('faq')
                        ->with('faq', $faq);
    }

}
