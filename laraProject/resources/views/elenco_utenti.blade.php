@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Elenco utenti')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/elenco_utenti.css') }}" >
<script src="{{asset('js/elenco_utenti.js')}}"></script>
@endsection

@section('content')
@if(session('message'))
<div class="message">{{session('message')}}</div>
@endif
@if(session('error'))
<div class="error">{{session('error')}}</div>
@endif

<div id="Mod_Container">
    <a href="{{ route('crea_società') }}">
        <button><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Crea società </button>
    </a>
</div>

<div id="Title">
    <h1>Utenti</h1>
</div>

<div id="Container">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Statistiche</th>
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($utenti as $utente)
            <tr>
                <td>{{ $utente->username }}</td>
                <td>{{ $utente->nome }}</td>
                <td>{{ $utente->livello }}</td> 
                @if($utente->livello=="società")
                <td class="Button"><a href="{{ route('statistiche_società', [$utente->id]) }}"><button type="submit"><i class="fa fa-bar-chart fa-lg"></i></button></a></td>
                <td class="Button"><a href="{{ route('form_modifica_società', [$utente->id]) }}"><button type="submit"><i class="fa fa-pencil fa-lg"></i></button></a></td>
                @else
                <td></td>
                <td></td>
                @endif
                <td class="Button"><a onclick="return conferma();" href="{{ route('elimina_utente', [$utente->id]) }}"><button type="submit"><i class="fa fa-trash fa-lg"></i></button></a></td>   
            </tr>
            @endforeach
        </tbody>
    </table>   
</div>
@endsection