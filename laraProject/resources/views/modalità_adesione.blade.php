@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Modalità di adesione come gestore di eventi')

@section('specific')
<!-- Stili relativi alla modalità di adesione -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/mod.css') }}" >
@endsection

<!-- Sezione centrale della pagina riguardante la modalità di adesione come gestore di eventi -->
@section('content')
<section>
    <p class="Title">
        Modalità di adesione come gestore di eventi
    </p> 
    <div class="Explanation">
        Per aderire come gestori di eventi è necessario registrarsi come società all'interno del sito.
        La registrazione avviene attraverso l'intervento dell'amministratore del sito, tramite i seguenti passi:
        <ul>
            <li>
                Invio di un'e-mail all'amministratore (<a href="mailto:ticketmania@gmail.com"><u>ticketmania@gmail.com</u></a>), nel quale dovrà essere specificata la volontà
                di aderire come gestore di eventi, specificando username, nome e password dell'account richiesto
            </li>
            <li>
                L'amministratore provvede alla creazione dell'account e, una volta ultimata, notifica la società
            </li>
            <li>
                La società può a questo punto accedere al sito attraverso le credenziali del proprio account
                e usufruire di tutte le funzionalità di cui ha bisogno
            </li>     
        </ul>
        I sequenti passaggi dovranno essere ripetuti anche nel caso in cui la società voglia modificare o cancellare
        il proprio account!
    </div>
</section>
@endsection