<form method="get" action="{{ route('catalogo_filtro') }}">
            @csrf
            <input type="text" name="descrizione" placeholder="Descrizione" value={{$descrizione ?? ''}}>
            <input type="month" placeholder="Anno e mese (AAAA-MM)" name="mese" value={{$mese ?? ''}}>
            <select name="regione">
                <option disabled selected value>--Regione--</option>
                <option value="Abruzzo">Abruzzo</option>
                <option value="Basilicata">Basilicata</option>
                <option value="Calabria">Calabria</option>
                <option value="Campania">Campania</option>
                <option value="Emilia-Romagna">Emilia-Romagna</option>
                <option value="Friuli-Venezia Giulia">Friuli-Venezia Giulia</option>
                <option value="Lazio">Lazio</option>
                <option value="Liguria">Liguria</option>
                <option value="Lombardia">Lombardia</option>
                <option value="Marche">Marche</option>
                <option value="Molise">Molise</option>
                <option value="Piemonte">Piemonte</option>
                <option value="Puglia">Puglia</option>
                <option value="Sardegna">Sardegna</option>
                <option value="Sicilia">Sicilia</option>
                <option value="Toscana">Toscana</option>
                <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
                <option value="Umbria">Umbria</option>
                <option value="Valle d'Aosta">Valle d'Aosta</option>
                <option value="Veneto">Veneto</option>
            </select>
            <select name="società">
                <option disabled selected value>--Società--</option>
                @foreach($elenco_società as $società)
                <option value="{{ $società->nome }}">{{ $società->nome }}</option>
                @endforeach
            </select>
            <button type="submit"><i class="fa fa-search fa-lg"></i> Cerca</button>
</form>