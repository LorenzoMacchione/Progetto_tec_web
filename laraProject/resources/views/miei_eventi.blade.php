@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Miei Eventi')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/miei_eventi.css') }}" >
<script src="{{ asset('js/miei_eventi.js') }}"></script>
@endsection

@section('content')
@if(session('message'))
<div class="message">{{session('message')}}</div>
@endif
@if(session('error'))
<div class="error">{{session('error')}}</div>
@endif
<div id="Mod_Container">
    <a href="{{ route('crea_evento') }}">
        <button><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Crea evento </button>
    </a>
</div>

<div id="Title">
    <h1>I miei eventi</h1>
</div>

<div id="Container">
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Biglietti venduti</th>
                <th>Venduti (%)</th>
                <th>Incasso</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventi as $evento)
            <tr>
                <td>{{ $evento->titolo }}</td>
                <td>{{ $evento->data }}</td>
                <td>{{ $evento->ticket_count }}</td>
                <td>{{ floor(10000*(($evento->ticket_count)/($evento->biglTot)))/100 }} %</td>
                <td>{{ $evento->ticket_incasso??0 }} €</td>
                <td class="Button"><a href="{{ route('evento', [$evento->eventId]) }}"><button>Vai all'evento</button></a></td>
                <td class="Button"><a href="{{ route('form_modifica_evento', [$evento->eventId]) }}"><button><i class="fa fa-pencil fa-lg"></i></button></a></td>
                <td class="Button" id="cancellazione"><a onclick="return conferma();"href="{{ route('cancella_evento', [$evento->eventId]) }}"><button><i class="fa fa-trash fa-lg"></i></button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>   
</div>
@endsection