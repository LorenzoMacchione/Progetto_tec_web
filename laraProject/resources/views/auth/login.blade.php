@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Login')

@section('specific')
<!-- Stili relativi al login -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" >
@endsection

<!-- Sezione centrale della pagina di login -->
@section('content')
<div id="Login_Div">
    <section id="Login">
        {{ Form::open(array('route' => 'login', 'class' => 'Form')) }}
        <h2>Accedi</h2>
        {{ Form::label('username', 'username') }}
        {{ Form::text('username') }}
        @if ($errors->first('username'))
        <ul class="errors">
            @foreach ($errors->get('username') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif
        {{ Form::label('password', 'password') }}
        {{ Form::password('password') }}
        @if ($errors->first('password'))
        <ul>
            @foreach ($errors->get('password') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @endif
        {{ Form::submit('Accedi', ['class' => 'submit'])}}
        {{ Form::close() }}
        <a href="{{ route('register') }}">Non hai un account? Registrati!</a>
    </section>
</div>
@endsection