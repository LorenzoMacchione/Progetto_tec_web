@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Evento')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/details.css') }}" >
<script src="{{ asset('js/details.js') }}"></script>
<script>
    function start(){
        let la = {{$evento -> lat}};
        let lo = {{$evento -> long}};
        initMap(la, lo);
    }
</script>
@endsection

<!-- Sezione centrale della pagina dei dettagli di un evento -->
@section('content')
<section id="Event">
    <h1 id="Name">{{ $evento -> titolo }}</h1>
    <section id="Top_Info">
        <div id="Image">
            <img src="../img/{{ $evento -> immagine }}">
        </div>
        <div id="Details">
            <div id="Details_Top">
                <div id="Details_Top_Left">
                    <p id="Society">{{ $nome_societa }}</p>
                    <p id="Location">{{ $evento -> luogo }}</p>
                    <p id="Date">{{ $evento-> data }} | {{ $evento->orario }}</p>
                    <p id="Partecipants">Persone intenzionate a partecipare: {{ $partecipanti }}</p>
                </div>
                <div id="Details_Top_Right">
                    @if(($evento ->inizioSconto > now())||($evento->inizioSconto == null))
                    <p id="Price">{{ $evento->prezzo }} €</p>
                    @else

                    <p id="Price">{{ $evento->prezzoScontato}} €  </p><p id="Price-vecchio">{{ $evento->prezzo }} €</p>
                    @endif
                </div>
            </div>
            <div id="Details_Bottom">
                @guest
                <h2 style="color: red;">Per acquistare i biglietti o manifestare l'intenzione di partecipare è necessario accedere!</h2>
                @endguest
                @can('isUser')
                <form action="{{ route('partecipa', [$evento -> eventId])}}" method="post">
                    @csrf
                    @if(!$partecipo)
                    <button id="Partecipate" type="submit"><i class="fa fa-heart fa-lg"></i> Parteciperò</button> 
                    @else
                    <button id="Partecipate" type="submit"><i class="fa fa-minus-circle fa-lg"></i> Non parteciperò</button> 
                    @endif
                </form>
                <form action="{{ route('acquisto', [$evento -> eventId])}}" method="post">
                    @csrf
                    <input type="number" placeholder="N° biglietti" id="N_Tickets" name="biglietti">
                    <select name="metodo_pagamento">
                        <option value="bonifico">Bonifico</option>
                        <option value="paypal">Paypal</option>
                        <option value="carta">Carta di credito</option>
                    </select>
                    <button type="submit" value="Acquista"><i class="fa fa-shopping-cart fa-lg"></i>Acquista</button>
                </form>
                @endcan
            </div>
            <h3 class="Response">{{ Session::get('response') }}</h3>
            @if ($errors->first('biglietti'))
            @foreach ($errors->get('biglietti') as $message)
            <div>
                <h4 class="Errors">{{ $message }}</h4>
            </div>
            @endforeach
            @endif
        </div>
    </section>
    <section id="Center_Info">
        <h2>Descrizione</h2>
        <p id="Description">{{ $evento->descrizione }}</p>
        <h2>Programma</h2>
        <p id="Schedule">{{ $evento->programma }}</p>
    </section>
    <section id="Bottom_Info">
        <div id="Map_Container">
            <div id="Map"></div>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApUc4g9yroX5T4yuVhJHYfdsfO_RGU35g&callback=start&libraries=&v=weekly"></script>
            <div id="Reach_Us">
                <h2>Come raggiungerci</h2>
                <p>{{ $evento -> indStrad }}</p> 
            </div>
        </div>
    </section>
</section>
@endsection