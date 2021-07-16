@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', "Riepilogo d'acquisto")

@section('specific')
<!-- Stili relativi al riepilogo d'acquisto -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/riepilogo.css') }}" >
@endsection

<!-- Sezione centrale della pagina del riepilogo d'acquisto -->
@section('content')
<div id="Acquisto">
    @isset($disponibili)
    <h1>Hai richiesto troppi biglietti, ne sono disponibili soltanto: {{ $disponibili }}</h1>
    <br>
    <h2><a href="{{ route('evento', [$eventId]) }}">Torna al dettaglio dell'evento</a></h2>
    @endisset
    
    @isset($data)
    <h1>Hai richiesto dei biglietti per un evento già terminato il {{ $data }}</h1>
    <h2><a href="{{ route('evento', [$eventId]) }}">Torna al dettaglio dell'evento</a></h2>
    @endisset
    
    @isset($evento)
    <h1>Riepilogo dell'acquisto</h1>
    <table id="Riepilogo">
        <tr><th>Acquirente</th><td>{{ $utente }}</td></tr>
        <tr><th>Nome dell'evento</th><td>{{ $evento }}</tr>
        <tr><th>Data d'acquisto</th><td>{{ $data_acquisto }}</td></tr>
        <tr><th>Metodo di pagamento</th><td>{{ $metodo_pagamento }}</td></tr>
        <tr><th>Biglietti acquistati</th><td>{{ $biglietti }}</td></tr>
        <tr><th>Costo complessivo</th><td>{{ $prezzo*$biglietti }}</td></tr>
    </table>
    @endisset
</div>
@endsection