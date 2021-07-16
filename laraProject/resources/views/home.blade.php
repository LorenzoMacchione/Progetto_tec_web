@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Home')

@section('specific')
<!-- Stili relativi alla home -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" >
@endsection

@section('search')
@include('layouts/search')
@endsection

<!-- Sezione centrale della home -->
@section('content')
<section id="Events_Container">

    @isset($eventi)
    @if($eventi->count() != 0)
    <p id="Parteciperò">
        Eventi a cui parteciperai            
    </p>
    <div class="Events">
        @foreach($eventi as $event)
        <div class="Event">
            <a href="{{ route('evento', [$event->eventId]) }}">
                <img src="img/{{ $event->immagine }}">
                <h3>{{ $event-> titolo }}</h3>
                <p>{{ $event->descrizione }}</p>
            </a>
        </div>
        @endforeach
    </div>
    @endif
    @endif

    <p id="Popolari">
        Eventi popolari            
    </p>
    <div class="Events">
        @foreach($most_populars as $event)
        <div class="Event">
            <a href="{{ route('evento', [$event->eventId]) }}">
                <img src="img/{{ $event->immagine }}">
                <h3>{{ $event-> titolo }}</h3>
                <p>{{ $event->descrizione }}</p>
            </a>
        </div>
        @endforeach
    </div>

    <p id="In_Offerta">
        In offerta last minute
    </p>
    <div class="Events">   
        @foreach($scontati as $scontato)
        <div class="Event">
            <a href="{{ route('evento', [$scontato->eventId]) }}">
                <img src="img/{{ $scontato->immagine }}">
                <h3>{{ $scontato-> titolo }}</h3>
                <p>{{ $scontato->descrizione }}</p>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endsection