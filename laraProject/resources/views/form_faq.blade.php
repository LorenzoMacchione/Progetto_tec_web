@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Form per le FAQ')

@section('specific')
<!-- Stili relativi alle faq -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/form_faq.css') }}" >
<!-- Include jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('js/form_faq.js') }}"></script>
@endsection

<!-- Sezione centrale della pagina delle faq -->
@section('content')

<div id="Modify_Div">
    <section id="Modify">

        @isset($faq)
        {{ Form::open(array(route('modifica_faq',[$faq->faqId]), 'method' => 'POST')) }}
        <h2>Modifica FAQ</h2>
        <div>
            {{ Form::label('domanda', 'domanda') }}
            {{ Form::text('domanda', $faq->domanda) }}
            @if ($errors->first('domanda'))
            <ul class="errors">
                @foreach ($errors->get('domanda') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div>
            {{ Form::label('risposta', 'risposta') }}
            {{ Form::text('risposta', $faq->risposta) }}
            @if ($errors->first('risposta'))
            <ul class="errors">
                @foreach ($errors->get('risposta') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        {{ Form::submit('Conferma', ['class' => 'submit']) }}
        {{ Form::close() }}
        @else
        {{ Form::open(array(route('crea_faq'), 'method' => 'POST', 'id' => 'creaFaq')) }}
        <h2>Crea FAQ</h2>
        <div>
            {{ Form::label('domanda', 'domanda') }}
            {{ Form::text('domanda', '', ['class' => 'input', 'id' => 'domanda']) }}
        </div>
        <div>
            {{ Form::label('risposta', 'risposta') }}
            {{ Form::text('risposta', '', ['class' => 'input', 'id' => 'risposta']) }}
        </div>
        {{ Form::submit('Conferma', ['class' => 'submit']) }}
        {{ Form::close() }}
        @endif
    </section>   
</div>

@endsection