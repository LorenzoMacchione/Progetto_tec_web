@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Profilo')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/profilo.css') }}" >
@endsection

@section('content')

<div id="Mod_Container">
    <a href="{{route('mostra_modifica_profilo')}}">
        <button><i class="fa fa-pencil" aria-hidden="true"></i> Modifica profilo </button>
    </a>
</div>

<div class="Title">
    <p><i class="fa fa-user"></i>&nbsp;Profilo</p>
</div>

<div id="Profile_Container">
    <p>Eventi a cui parteciperai</p>
    <table>
        <tr><th>Nome dell'evento</th><th>Prezzo</th><th>Data</th><th>Dettagli dell'evento</th></tr>
        @foreach($parteciperò as $evento)
        <tr>
            <td>{{$evento -> titolo}}</td>
            @if(($evento->inizioSconto > now())||($evento->inizioSconto == null))
            <td>{{$evento -> prezzo}} €</td>
            @else
            <td>{{$evento -> prezzoScontato}} €</td>
            @endif
            <td>{{$evento -> data}}</td>
            <td class="Details">
                <a href="{{ route('evento', [$evento->eventId]) }}">
                    <button>Dettagli</button>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    
    <p>Biglietti acquistati</p>
    <table>
        <tr><th>Data d'acquisto</th><th>Nome dell'evento</th><th>Prezzo</th><th>Metodo di pagamento</th></tr>
        @foreach($biglietti as $biglietto)
        <tr>
            <td>{{$biglietto -> dataAcquisto}}</td>
            <td>{{$biglietto -> titolo}}</td>
            <td>{{$biglietto -> prezzo}} €</td>
            <td>{{$biglietto -> metodoPagamento}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection