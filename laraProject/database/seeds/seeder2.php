<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class seeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            ['username' => 'clieclie', 'nome' => 'clieclie', 'password' => Hash::make('rnsWprFx'), 'livello' => 'utente'],
            ['username' => 'orgaorga', 'nome' => 'orgaorga', 'password' => Hash::make('rnsWprFx'), 'livello' => 'società'],
            ['username' => 'adminadmin', 'nome' => 'adminadmin', 'password' => Hash::make('rnsWprFx'), 'livello' => 'amministratore'],
            ['username' => 'utente1', 'nome' => 'Francesco', 'password' => Hash::make('password1'), 'livello' => 'utente'],
            ['username' => 'utente2', 'nome' => 'Marco', 'password' => Hash::make('password2'), 'livello' => 'utente'],
            ['username' => 'società1', 'nome' => 'Live Society', 'password' => Hash::make('password1'), 'livello' => 'società'],
            ['username' => 'società2', 'nome' => 'Italia Internazionale', 'password' => Hash::make('password2'), 'livello' => 'società'],
        ]);

        //Popola la tabella delle faq
        \DB::table('faqs')->insert([
            ['domanda' => 'E\' previsto il rimborso per i biglietti acquistati?', 'risposta' => 'No.'],
            ['domanda' => 'Il sito prevede sconti per gli eventi?', 'risposta' => 'Si.'],
        ]);

        //Popola la tabella degli eventi
        \DB::table('events')->insert([
            [
                'titolo' => 'Justice Tour',
                'descrizione' => 'Il tour doveva iniziare nell\'estate del 2020, ma a causa delle restrizioni dovute al COVID-19 è stato rinviato all\'anno successivo. L\'attesa è però finita, Justin Bieber sta per tornare finalmente in Italia con i suoi nuovissimi successi tratti dal nuovo album "Justice".',
                'immagine' => 'Justice.jpg',
                'programma' => 'Verranno cantate tutte le nuove canzoni del nuovo album oltre ai più grandi successi del passato.',
                'data' => date('2021-06-30'),
                'orario' => '20:00',
                'regione' => 'Lombardia',
                'luogo' => 'Milano',
                'lat' => 45.4784489,
                'long' => 9.1200953,
                'indStrad' => 'Per raggiungere il luogo si consiglia di utilizzare la metropolitana, per evitare lunghe code di traffico.',
                'prezzo' => 70.99,
                'biglTot' => 80000,
                'prezzoScontato' => 60.99,
                'inizioSconto' => date('2021-05-25'),
                'notorietà' => 6,
                'gestore' => 2,
            ],
            [
                'titolo' => 'After Hours Tour',
                'descrizione' => 'Il tour doveva iniziare nell\'autunno del 2020, ma a causa delle restrizioni dovute al COVID-19 è stato rinviato all\'anno successivo. L\'attesa è però finita, The Weeknd sta per arrivare per la prima volta in Italia con i suoi nuovissimi successi tratti dall\' album di successo "After Hours".',
                'immagine' => 'AfterHours.jpg',
                'programma' => 'Verranno cantate tutte le nuove canzoni del nuovo album oltre ai più grandi successi del passato.',
                'data' => date('2021-07-24'),
                'orario' => '21:00',
                'regione' => 'Lombardia',
                'luogo' => 'Milano',
                'lat' => 45.4784489,
                'long' => 9.1200953,
                'indStrad' => 'Per raggiungere il luogo si consiglia di utilizzare la metropolitana, per evitare lunghe file di traffico.',
                'prezzo' => 80.50,
                'biglTot' => 80000,
                'prezzoScontato' => 70.50,
                'inizioSconto' => date('2021-05-19'),
                'notorietà' => 9,
                'gestore' => 2,
            ],
            [
                'titolo' => 'Future Nostalgia Tour',
                'descrizione' => 'Dua Lipa torna in Italia con i successi del suo nuovo album.',
                'immagine' => 'FutureNostalgia.jpg',
                'programma' => 'Verranno cantate tutte le nuove canzoni del nuovo album e ci saranno artisti ospiti a sorpresa.',
                'data' => date('2021-07-18'),
                'orario' => '22:00',
                'regione' => 'Piemonte',
                'luogo' => 'Torino',
                'lat' => 45.0420649,
                'long' => 7.6503665,
                'indStrad' => 'Il luogo è facilmente raggiungibile attraverso qualsiasi mezzo di trasporto seguendo i cartelli stradali.',
                'prezzo' => 64.00,
                'biglTot' => 50000,
                'prezzoScontato' => 54.00,
                'inizioSconto' => date('2021-05-13'),
                'notorietà' => 3,
                'gestore' => 6,
            ],
            [
                'titolo' => 'Positions Tour',
                'descrizione' => 'Ariana Grande torna finalmente in Italia dopo un anno di assenza dalle scene musicali.',
                'immagine' => 'Positions.jpg',
                'programma' => 'Verranno cantate tutte le canzoni del nuovo album e saranno presenti numerosi artisti ospiti.',
                'data' => date('2021-09-15'),
                'orario' => '23:00',
                'regione' => 'Lazio',
                'luogo' => 'Roma',
                'lat' => 41.934081,
                'long' => 12.4525363,
                'indStrad' => 'Per raggiungere il luogo è consigliato l\'utilizzo della metropolitana.',
                'prezzo' => 75.00,
                'biglTot' => 60000,
                'prezzoScontato' => 55.00,
                'inizioSconto' => date('2021-05-10'),
                'notorietà' => 0,
                'gestore' => 7,
            ],
            [
                'titolo' => 'Silk Sonic Tour',
                'descrizione' => 'Dopo 5 anni dall\'ultimo album, Bruno Mars torna finalmente in tour insieme ad Anderson Paak. Non perderti i Silk Sonic!',
                'immagine' => 'SilkSonic.jpg',
                'programma' => 'Verranno cantate canzoni del tutto inedite.',
                'data' => date('2022-01-20'),
                'orario' => '03:00',
                'regione' => 'Lazio',
                'luogo' => 'Roma',
                'lat' => 41.934081,
                'long' => 12.4525363,
                'indStrad' => 'Per raggiungere il luogo è consigliato l\'utilizzo della metropolitana.',
                'prezzo' => 47.00,
                'biglTot' => 75000,
                'prezzoScontato' => 37.85,
                'inizioSconto' => date('2022-01-15'),
                'notorietà' => 0,
                'gestore' => 7,
            ],
        ]);

        //Popola la tabella dei biglietti
        \DB::table('tickets')->insert([
            ['titolo' => 'Justice Tour', 'prezzo' => 60.99, 'dataAcquisto' => date('2021-05-27'), 'metodoPagamento' => 'bonifico', 'acquirente' => 1, 'evento' => 1],
            ['titolo' => 'Justice Tour', 'prezzo' => 60.99, 'dataAcquisto' => date('2021-05-27'), 'metodoPagamento' => 'bonifico', 'acquirente' => 1, 'evento' => 1],
            ['titolo' => 'After Hours Tour', 'prezzo' => 70.50, 'dataAcquisto' => date('2021-06-08'), 'metodoPagamento' => 'paypal', 'acquirente' => 1, 'evento' => 2],
            ['titolo' => 'After Hours Tour', 'prezzo' => 70.50, 'dataAcquisto' => date('2021-06-08'), 'metodoPagamento' => 'paypal', 'acquirente' => 4, 'evento' => 2],
            ['titolo' => 'After Hours Tour', 'prezzo' => 70.50, 'dataAcquisto' => date('2021-06-08'), 'metodoPagamento' => 'paypal', 'acquirente' => 5, 'evento' => 2],
            ['titolo' => 'Future Nostalgia Tour', 'prezzo' => 54.00, 'dataAcquisto' => date('2021-05-20'), 'metodoPagamento' => 'bonifico', 'acquirente' => 5, 'evento' => 3],
        ]);

        //Popola la tabella dei partecipanti
        \DB::table('partecipants')->insert([
            ['partecipante' => 1, 'evento' => 3],
            ['partecipante' => 1, 'evento' => 2],
            ['partecipante' => 1, 'evento' => 1],
        ]);
    }
}
