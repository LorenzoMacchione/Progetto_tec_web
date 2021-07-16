@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Modifica del profilo')

@section('specific')
<!-- Stili relativi al signup -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/modifica_profilo.css') }}" >
<script src="{{ asset('js/modifica_profilo.js') }}"></script>
@endsection

<!-- Sezione centrale della pagina di modifica del profilo -->
@section('content')
<div id="Modify_Div">
    <section id="Modify">
        @if($lv == 2)
        {{ Form::open(array('route' => 'modifica_profilo')) }}
        <h2>Modifica del profilo</h2>
        @endif
        @if($lv == 3)
        {{ Form::open(array(route('modifica_società', [$utente->id]))) }}
        <h2>Modifica della società</h2>
        @endif

        <h4>Lasciare il campo vuoto nel caso in cui non lo si voglia modificare</h4>

        {{ Form::label('username', 'username') }}
        {{ Form::text('username', $utente->username, ['disabled']) }}

        {{ Form::label('nome', 'nome') }}
        {{ Form::text('nome', $utente->nome) }}
        @if ($errors->first('nome'))
        <ul class="errors">
            @foreach ($errors->get('nome') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif

        {{ Form::label('password', 'password') }}
        {{ Form::password('password', ['placeholder' => 'Nuova password', 'id' => 'password']) }}
        <input type="checkbox" onclick="showPassword()" class="checkbox"><label style="font-size: 16px;">Mostra la password</label></input>
        @if ($errors->first('password'))
        <ul class="errors">
            @foreach ($errors->get('password') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif

        {{ Form::submit('Conferma', ['class' => 'submit']) }}
        {{ Form::close() }}
    </section>   
</div>
@endsection