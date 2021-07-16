@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Modalità di fornitura dei servizi')

@section('specific')
<!-- Stili relativi alla modalità di fornitura dei servizi -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/mod.css') }}" >
@endsection

<!-- Sezione centrale della pagina riguardante la moodalità di fornitura dei servizi -->
@section('content')
<section>
    <p class="Title">
        Modalità di fornitura dei servizi
    </p> 
    <div class="Explanation">
        Questo sito nasce con lo scopo di permettere alle società organizzatrici di eventi registrate di poter
        organizzare e gestire la compravendita di biglietti per determinati concerti.
        <br>
        <br>
        Per ogni concerto, la società rende vendibili un certo numero di biglietti, stabilendone il prezzo ed 
        eventuali sconti (per acquisti effettuati negli ultimi giorni di vendita).
        <br>
        <br>
        I biglietti potranno essere acquistati dagli utenti, ovviamente soltanto in seguito all'accesso, 
        attraverso la modalità di pagamento scelta tra quelle disponibili.
        <br>
        <br>
        Una volta effettuato l'acquisto sarà possibile vedere il riepilogo di quest'ultimo, ma <u>non sarà
        possibile richiedere un rimborso!</u>

    </div>
</section>
@endsection