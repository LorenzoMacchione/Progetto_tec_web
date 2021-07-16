<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/*
  ROTTE PUBBLICHE (LIVELLO 1)
 */

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showHome" del controller "Controller1"
Route::get('/', 'Controller1@showHome')
        ->name('home');

//Rotte di autenticazione
Auth::routes();

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showCatalog_filtered" del controller "Controller1"
Route::get('/catalogo', 'Controller1@showCatalog_filtered')
        ->name('catalogo_filtro');

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showDetails" del controller "Controller1"
Route::get('/evento/{eventId}', 'Controller1@showDetails')
        ->name('evento');

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showFaq" del controller "Controller1"
Route::get('/faq', 'Controller1@showFaq')
        ->name('faq');

//Tale rotta:
//- restituisce la view "modalità_fornitura"
Route::view('/modalità_fornitura', 'modalità_fornitura')
        ->name('modalità_fornitura');

//Tale rotta:
//- restituisce la view "modalità_adesione"
Route::view('/modalità_adesione', 'modalità_adesione')
        ->name('modalità_adesione');

/*
  ROTTE DEL LIVELLO 2
 */

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showProfile" del controller "Controller2"
Route::get('/profilo', 'Controller2@showProfile')
        ->name('profilo')->middleware("can:isUser");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showModificaProfilo" del controller "Controller2"
Route::get('/profilo/modifica', 'Controller2@showModificaProfilo')
        ->name('mostra_modifica_profilo')->middleware("can:isUser");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "modificaProfilo" del controller "Controller2"
Route::post('/profilo/modifica', 'Controller2@modificaProfilo')
        ->name('modifica_profilo')->middleware("can:isUser");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "acquistaBiglietto" del controller "Controller2"
Route::post('/evento/{eventId}/acquisto', 'Controller2@acquistaBiglietto')
        ->name('acquisto')->middleware("can:isUser");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "partecipaEvento" del controller "Controller2"
Route::post('/evento/{eventId}/partecipa', 'Controller2@partecipaEvento')
        ->name('partecipa')->middleware("can:isUser");

/*
  ROTTE DEL LIVELLO 3
 */

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showMieiEventi" del controller "Controller3"
Route::get('/miei_eventi', 'Controller3@showMieiEventi')
        ->name('miei_eventi')->middleware("can:isOrg");

//Tale rotta:
//- restituisce la view "crea_evento"
Route::view('/crea_evento', 'crea_evento')
        ->name('crea_evento')->middleware("can:isOrg");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "creaEvento" del controller "Controller3"
Route::post('/crea_evento', 'Controller3@creaEvento')
        ->name('crea_evento')->middleware("can:isOrg");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showModificaEvento" del controller "Controller3"
Route::get('/form_modifica_evento/{eventId}', 'Controller3@showModificaEvento')
        ->name('form_modifica_evento')->middleware("can:isOrg");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "modificaEvento" del controller "Controller3"
Route::post('/modifica_evento', 'Controller3@modificaEvento')
        ->name('modifica_evento')->middleware("can:isOrg");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "cancellaEvento" del controller "Controller3"
Route::get('/cancella_evento/{eventId}', 'Controller3@cancellaEvento')
        ->name('cancella_evento')->middleware("can:isOrg");

/*
  ROTTE DEL LIVELLO 4
 */

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showElencoUtenti" del controller "Controller4"
Route::get('/elenco_utenti', 'Controller4@showElencoUtenti')
        ->name('elenco_utenti')->middleware("can:isAdmin");

//Tale rotta:
//- restituisce la view 'crea_società'
Route::view('/crea_società', 'crea_società')
        ->name('crea_società')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "newSociety" del controller "Controller4"
Route::post('/crea_società', 'Controller4@creaSocietà')
        ->name('crea_società')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showModificaSocietà" del controller "Controller4"
Route::get('/modifica_società/{userId}', 'Controller4@showModificaSocietà')
        ->name('form_modifica_società')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "modificaSocietà" del controller "Controller4"
Route::post('/modifica_società/{userId}', 'Controller4@modificaSocietà')
        ->name('modifica_società')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "eliminaUtente" del controller "Controller4"
Route::get('/elimina_utente/{userId}', 'Controller4@eliminaUtente')
        ->name('elimina_utente')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showStatisticheSocietà" del controller "Controller4"
Route::get('statistiche_società/{userId}', 'Controller4@showStatisticheSocietà')
        ->name('statistiche_società')->middleware("can:isAdmin");

//Tale rotta:
//- restituisce la view 'form_faq'
Route::view('/form_faq', 'form_faq')
        ->name('form_faq')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo post
//- è associta al metodo "creaFaq" del controller "Controller4"
Route::post('/crea_faq', 'Controller4@creaFaq')
        ->name('crea_faq')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "showModificaFaq" del controller "Controller4"
Route::get('/modifica_faq/{faqId}', 'Controller4@showModificaFaq')
        ->name('modifica_faq')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo post
//- è associata al metodo "modificaFaq" del controller "Controller4"
Route::post('/modifica_faq/{faqId}', 'Controller4@modificaFaq')
        ->name('modifica_faq')->middleware("can:isAdmin");

//Tale rotta:
//- è di tipo get
//- è associata al metodo "eliminaFaq" del controller "Controller4"
Route::get('/elimina_faq/{faqId}', 'Controller4@eliminaFaq')
        ->name('elimina_faq')->middleware("can:isAdmin");
