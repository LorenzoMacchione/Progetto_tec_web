@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Modifica evento')

@section('specific')
<!-- Stili relativi ai dettagli di un evento -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/crea_modifica_evento.css') }}" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/crea_modifica_evento.js') }}"></script>

@endsection

<!-- Sezione centrale della pagina della form di creazione o modifica di un evento -->
@section('content')
<section id="Event">
    <form action="{{ route('modifica_evento') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="eventId" value="{{ $evento->eventId }}">
        <h1>Modifica di un evento</h1>
        <section id="Top">
            <div id="Image">
                <h2>Per modificare l'immagine cliccare (altrimenti non fare alcuna azione)</h2>
                <!-- Viene visualizzata l'immagine attuale dell'evento. Per modificarla basta cliccare sull'immagine -->
                <input type="file"  accept="image/*" name="immagine" id="file"  onchange="loadFile(event)" style="display: none">
                <label for="file" style="cursor: pointer;">
                    <img src="../img/{{ $evento -> immagine }}" id="output" width="300" />
                </label>
            </div>
            <div id="Info">
                <div>
                    <label id="Titolo">Titolo<input type="text" name="titolo" value="{{ old('titolo', $evento->titolo) }}"></label>   
                    @if ($errors->first('titolo'))
                    @foreach ($errors->get('titolo') as $message)
                    <h3 class="Errors">{{ $message }}</h3>
                    @endforeach  
                    @endif
                </div>
                <div id="Date_Time_Info">
                    <div id="Data">
                        <label>Data<input type="date" name='data' value="{{ old('data', $evento->data) }}"></label>
                        @if ($errors->first('data'))
                        @foreach ($errors->get('data') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                    <div id="Orario">
                        <label>Orario<input type="time" name='orario' value="{{ old('orario', $evento->orario) }}"></label>
                        @if ($errors->first('orario'))
                        @foreach ($errors->get('orario') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div id="Location_Info">
                    <div id="Luogo">
                        <label>Luogo<input type="text" name="luogo" value="{{ old('luogo', $evento->luogo) }}"></label>
                        @if ($errors->first('luogo'))
                        @foreach ($errors->get('luogo') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                    <div id="Regione">
                        <label for="regione">Regione
                            <select name="regione" id="regione"">
                                <option value="Abruzzo" {{ old('regione', $evento->regione) == 'Abruzzo' ? 'selected' : '' }}>Abruzzo</option>
                                <option value="Basilicata" {{ old('regione', $evento->regione) == 'Basilicata' ? 'selected' : '' }}>Basilicata</option>
                                <option value="Calabria" {{ old('regione', $evento->regione) == 'Calabria' ? 'selected' : '' }}>Calabria</option>
                                <option value="Campania" {{ old('regione', $evento->regione) == 'Campania' ? 'selected' : '' }}>Campania</option>
                                <option value="Emilia-Romagna" {{ old('regione', $evento->regione) == 'Emilia-Romagna' ? 'selected' : '' }}>Emilia-Romagna</option>
                                <option value="Friuli-Venezia Giulia" {{ old('regione', $evento->regione) == 'Friuli-Venezia Giulia' ? 'selected' : '' }}>Friuli-Venezia Giulia</option>
                                <option value="Lazio" {{ old('regione', $evento->regione) == 'Lazio' ? 'selected' : '' }}>Lazio</option>
                                <option value="Liguria" {{ old('regione', $evento->regione) == 'Liguria' ? 'selected' : '' }}>Liguria</option>
                                <option value="Lombardia" {{ old('regione', $evento->regione) == 'Lombardia' ? 'selected' : '' }}>Lombardia</option>
                                <option value="Marche" {{ old('regione', $evento->regione) == 'Marche' ? 'selected' : '' }}>Marche</option>
                                <option value="Molise" {{ old('regione', $evento->regione) == 'Molise' ? 'selected' : '' }}>Molise</option>
                                <option value="Piemonte" {{ old('regione', $evento->regione) == 'Piemonte' ? 'selected' : '' }}>Piemonte</option>
                                <option value="Puglia" {{ old('regione', $evento->regione) == 'Puglia' ? 'selected' : '' }}>Puglia</option>
                                <option value="Sardegna" {{ old('regione', $evento->regione) == 'Sardegna' ? 'selected' : '' }}>Sardegna</option>
                                <option value="Sicilia" {{ old('regione', $evento->regione) == 'Sicilia' ? 'selected' : '' }}>Sicilia</option>
                                <option value="Toscana" {{ old('regione', $evento->regione) == 'Toscana' ? 'selected' : '' }}>Toscana</option>
                                <option value="Trentino-Alto Adige" {{ old('regione', $evento->regione) == 'Trentino-Alto Adige' ? 'selected' : '' }}>Trentino-Alto Adige</option>
                                <option value="Umbria" {{ old('regione', $evento->regione) == 'Umbria' ? 'selected' : '' }}>Umbria</option>
                                <option value="Valle d'Aosta" {{ old('regione', $evento->regione) == 'Valle d\'Aosta' ? 'selected' : '' }}>Valle d'Aosta</option>
                                <option value="Veneto" {{ old('regione', $evento->regione) == 'Veneto' ? 'selected' : '' }}>Veneto</option>
                            </select>
                        </label>
                        @if ($errors->first('regione'))
                        @foreach ($errors->get('regione') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div id="Buy_Info">
                    <div id="Prezzo">
                        <label>Prezzo<input class="input-reduced" type="number" step="0.01" name="prezzo" value="{{ old('prezzo', $evento->prezzo) }}"></label>
                        @if ($errors->first('prezzo'))
                        @foreach ($errors->get('prezzo') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                    <div id="Biglietti">
                        <label>N° biglietti (deve essere maggiore di quelli già venduti)<input class="input-reduced" type="number" name="biglietti" value="{{ old('biglietti', $evento->biglTot) }}"></label>
                        @if ($errors->first('biglietti'))
                        @foreach ($errors->get('biglietti') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                        <!-- Biglietti già venduti -->
                        <input type="hidden" name="venduti" value="{{ $venduti }}">
                    </div>
                </div>
                <div>
                    <br>
                    <p>Lasciare i campi vuoti se non è previsto uno sconto:</p>
                    <br>
                </div>
                <div id="Discount_Info">
                    <div id="Inizio_Sconto">
                        <label>Inizio sconto<input class="optional" type="date" name="inizio_sconto" value="{{ old('inizio_sconto', $evento->inizioSconto) }}"></label>
                        @if ($errors->first('inizio_sconto'))
                        @foreach ($errors->get('inizio_sconto') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                    <div id="Sconto">
                        <label>Sconto [%]<input class="input-reduced optional" type="number" step="any" name="sconto" value="{{ old('sconto', $sconto) }}"></label>
                        @if ($errors->first('sconto'))
                        @foreach ($errors->get('sconto') as $message)
                        <h3 class="Errors">{{ $message }}</h3>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section id="Bottom">
            <label>Descrizione <textarea name="descrizione" rows="5">{{ old('descrizione', $evento->descrizione) }}</textarea></label>
            @if ($errors->first('descrizione'))
            @foreach ($errors->get('descrizione') as $message)
            <h3 class="Errors">{{ $message }}</h3>
            @endforeach
            @endif
            <label>Programma <textarea name="programma" rows="5">{{ old('programma', $evento->programma) }}</textarea></label>
            @if ($errors->first('programma'))
            @foreach ($errors->get('programma') as $message)
            <h3 class="Errors">{{ $message }}</h3>
            @endforeach
            @endif
            <label>Indicazioni stradali <textarea name="indicazioni" rows="5">{{ old('indicazioni', $evento->indStrad) }}</textarea></label>
            @if ($errors->first('indicazioni'))
            @foreach ($errors->get('indicazioni') as $message)
            <h3 class="Errors">{{ $message }}</h3>
            @endforeach
            @endif
        </section>
        <div id="map-container">
            <p>Selezionare un nuovo punto sulla mappa se si vuole modificare il luogo dell'evento (altrimenti non fare alcuna azione)</p>
            <div id="map"></div>
            <!-- input. le cooardinate vengono aggiunte dallo script quando si clicca sulla mappa -->
            @if ($errors->first('latitudine'))
            @foreach ($errors->get('latitudine') as $message)
            <h3 class="Errors">{{ $message }}</h3>
            @endforeach
            @endif
            <input type="hidden" id="latitudine" name="latitudine" value="{{ old('latitudine', $evento->lat) }}">
            @if ($errors->first('longitudine'))
            @foreach ($errors->get('longitudine') as $message)
            <h3 class="Errors">{{ $message }}</h3>
            @endforeach
            @endif
            <input type="hidden" id="longitudine" name="longitudine" value="{{ old('longitudine', $evento->long) }}">
        </div>
        <section id="Submit">
            <button class="button" type="submit">Conferma</button>
            <button class="button" type="reset">Reset</button></a>
        </section>
    </form>
</section>
<!-- Script per far funzionare la mappa -->
<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZpiCICml7DmkjoJBTG598NF4sBM6pssE&callback=initMap">
</script>
@endsection