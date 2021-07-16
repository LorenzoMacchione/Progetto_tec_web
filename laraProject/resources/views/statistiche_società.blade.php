@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Statistiche società')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/statistiche_società.css') }}">
@endsection

@section('content')
<div id="Container">
    <h1>Statistiche di: {{ $utente->nome }}</h1>
    <table>
        <thead>
            <tr>
                <th>Eventi</th>
                <th>Biglietti venduti</th>
                <th>Incasso</th>                
            </tr>
        </thead>
        <tbody>            
            <tr>                 
                <td>{{$n_eventi}}</td>
                <td>{{$n_tickets}}</td>
                <td>{{$incasso_tot}} €</td>
            </tr>            
        </tbody>
    </table>   
</div>
@endsection

