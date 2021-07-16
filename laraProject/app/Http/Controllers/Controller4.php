<?php

namespace App\Http\Controllers;

use App\Models\Event_model;
use App\Models\User_model;
use App\Models\Faq_model;
use App\Models\Resources\User;
use App\Models\Ticket_model;
use App\Models\Resources\Faq;
use Auth;
use App\Http\Requests\NewSocietyRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\FaqCreateRequest;
use App\Http\Requests\FaqUpdateRequest;
use Illuminate\Support\Facades\Hash;

class Controller4 extends Controller {

    //Proprietà private del Controller che fungeranno da model
    protected $event_model;
    protected $ticket_model;
    protected $user_model;
    protected $faq_model;

    //Costruttore del Controller che inizializza le proprietà privata
    public function __construct() {
        $this->event_model = new Event_model;
        $this->ticket_model = new Ticket_model;
        $this->user_model = new User_model;
        $this->faq_model = new Faq_model;
    }

    //Restituisce la pagina con l'elenco degli utenti
    public function showElencoUtenti() {
        $users = $this->user_model->getAllUsers();

        return view('elenco_utenti')
                        ->with('utenti', $users);
    }

    //Crea una nuova società
    public function creaSocietà(NewSocietyRequest $request) {
        $user = new User;
        $user->username = $request->username;
        $user->nome = $request->nome;
        $user->livello = 'società';
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route('elenco_utenti'))->with('message', 'Società creata con successo!');
    }

    //Restituisce la pagina dove si può modificare il profilo di una società
    public function showModificaSocietà($id) {
        if (Auth::user()->id == $id) {
            return redirect('elenco_utenti')->with('error', 'Non puoi modificare l\'amministratore!');
        }
        $utente = $this->user_model->getUserById($id)->first();
        if ($utente == null) {
            return redirect('elenco_utenti')->with('error', 'Non puoi modificare un utente inesistente!');
        }
        if ($utente->livello == 'utente') {
            return redirect('elenco_utenti')->with('error', 'Non puoi modificare un utente!');
        }
        return view('modifica_profilo')
                        ->with('utente', $utente)
                        ->with('lv', 3);
    }

    //Modifica il profilo della società attraverso i dati passati
    public function modificaSocietà(UpdateProfileRequest $request, $id) {
        $utente = $this->user_model->getUserById($id);

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

        return redirect(route('elenco_utenti'))->with('message', 'Società modifica con successo!');
    }

    public function eliminaUtente($id) {
        if (Auth::user()->id == $id) {
            return redirect('elenco_utenti')->with('error', 'Non puoi eliminare l\'amministratore!');
        }
        $user = $this->user_model->getUserById($id)->first();
        if ($user == null) {
            return redirect('elenco_utenti')->with('error', 'Non puoi eliminare un utente inesistente!');
        }
        $user->delete();
        return redirect(route('elenco_utenti'))->with('message', 'Utente eliminato con successo!');
        ;
    }

    //Restituisce la pagina con le statistiche dell'utente selezionato
    public function showStatisticheSocietà(int $id) {
        $events = $this->event_model->getEventsBySociety($id);
        $utente = $this->user_model->getUserById($id)->first();
        if (Auth::user()->id == $id) {
            return redirect('elenco_utenti')->with('error', 'Non puoi richiedere statistiche riguardanti l\'amministratore!');
        }
        if ($utente == null) {
            return redirect('elenco_utenti')->with('error', 'Non puoi richiedere statistiche riguardanti una società inesistente!');
        }
        if ($utente->livello == 'utente') {
            return redirect('elenco_utenti')->with('error', 'Non puoi richiedere statistiche riguardanti un utente!');
        }
        $n_events = $events->count();
        $n_tickets = 0;
        $incasso_tot = 0;
        foreach ($events as $event) {
            $n_tickets += $event->ticket_count;
            $incasso_tot += $event->ticket_incasso;
        }

        return view('statistiche_società')
                        ->with('utente', $utente)
                        ->with('n_eventi', $n_events)
                        ->with('n_tickets', $n_tickets)
                        ->with('incasso_tot', $incasso_tot);
    }

    //Metodo che crea una faq
    public function creaFaq(FaqCreateRequest $request) {
        $faq = new Faq;
        $faq->domanda = $request->domanda;
        $faq->risposta = $request->risposta;
        $faq->save();
        return response()->json(['redirect' => route('faq')]);
    }

    //Restituisce la pagina dove si può modificare una faq
    public function showModificaFaq($id) {
        $faq = $this->faq_model->getFaqById($id)->first();
        if ($faq == null) {
            return redirect(route('faq'))->with('error', 'Non puoi modificare una faq inesistente!');
        }
        return view('form_faq')->with('faq', $faq);
    }

    //Metodo che modifica una faq
    public function modificaFaq(FaqUpdateRequest $request, $id) {
        $faq = $this->faq_model->getFaqById($id);
        if ($request->domanda != null) {
            $faq->update([
                'domanda' => $request->domanda,
            ]);
        }
        if ($request->risposta != null) {
            $faq->update([
                'risposta' => $request->risposta,
            ]);
        }
        return redirect(route('faq'))->with('message', 'Faq modificata con successo!');
    }

    //Metodo che elimina una faq
    public function eliminaFaq($id) {
        $faq = $this->faq_model->getFaqById($id)->first();
        if ($faq == null) {
            return redirect(route('faq'))->with('error', 'Non puoi eliminare una faq inesistente!');
        } else {
            $faq->delete();
            return redirect(route('faq'))->with('message', 'Faq eliminata con successo!');
        }
    }

}
