@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Catalogo')

@section('specific')
<!-- Stili relativi al catalogo -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/catalog.css') }}" >
@endsection

@section('search')
@include('layouts/search')
@endsection


<!-- Sezione centrale della pagina di catalogo -->
@section('content')
<section id="Catalog_Events_Container">
    <p id="Catalog_Title">
        Catalogo            
    </p>
    <div class="Catalog_Events">
        @if($events->count() == 0)
        <div class="Catalog_Event">
            <h1>Nessun risultato</h1>
        </div>
        @endif
        @foreach($events as $event)
        <div class="Catalog_Event">
            <a href="{{ route('evento', [$event->eventId]) }}">
                <!-- Titolo -->
                <div>
                    <h2>{{ $event-> titolo }}</h2>
                </div>
                <div class="Catalog_Event_Center">
                    <!-- Immagine -->
                    <div class='Catalog_Event_Img'>
                        <img src="img/{{ $event->immagine }}">
                    </div>
                    <!-- Descrizione -->
                    <div class='Catalog_Event_Description'>
                        <p>{{ $event->descrizione }}</p>
                    </div>
                    <div class='Catalog_Event_Info'>
                        <!-- Data -->
                        <div class="Catalog_Event_Date">
                            <p>Organizzato da: {{ $event->nome }}</p>
                            <br>
                            <p>{{ $event->regione }}</p>
                            <br>
                            <p>{{ $event->data }}</p>
                        </div>
                        <!-- Prezzo -->
                        <div class="Catalog_Event_Price">
                            @if(($event->inizioSconto > now())||($event->inizioSconto == null))
                            <p>{{ $event->prezzo }} €</p>
                            @else
                            <p>{{ $event->prezzoScontato}} €</p><p id="prezzo-vecchio">{{ $event->prezzo }} €</p>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        <!-- Definisce l'impaginazione  -->
        @if ($events->lastPage() != 1)
        <div id="Pagination">

            {{$events->appends(['descrizione' => request()->query('descrizione'), 'mese' => request()->query('mese'), 'regione' => request()->query('regione'),'società' => request()->query('società')])->links()    }}

            <div>
                {{ $events->firstItem() }}-{{ $events->lastItem() }} di {{ $events->total() }}
            </div>

        </div>
        @endif

    </div>
</section>
@endsection