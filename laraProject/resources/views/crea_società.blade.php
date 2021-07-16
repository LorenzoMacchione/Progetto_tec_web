@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Creazione società')

@section('specific')
<!-- Stili relativi al signup -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/signup.css') }}" >
@endsection

<!-- Sezione centrale della pagina di signup -->
@section('content')
<div id="Signup_Div">
    <section id="Signup">
        {{ Form::open(array('route' => 'crea_società')) }}
        <h2>Crea società</h2>
        {{ Form::label('username', 'username') }}
        {{ Form::text('username') }}
        @if ($errors->first('username'))
        <ul class="errors">
            @foreach ($errors->get('username') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif


        {{ Form::label('nome', 'nome') }}
        {{ Form::text('nome', '') }}
        @if ($errors->first('nome'))
        <ul class="errors">
            @foreach ($errors->get('nome') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif



        {{ Form::label('password', 'password') }}
        {{ Form::password('password') }}
        @if ($errors->first('password'))
        <ul class="errors">
            @foreach ($errors->get('password') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif
        {{ Form::submit('Conferma', ['class' => 'submit'])}}
        {{ Form::close() }}

    </section>
</div>
@endsection