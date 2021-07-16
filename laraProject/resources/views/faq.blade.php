@extends('layouts.body')

<!-- Titolo da appendere alla rotta -->
@section('title', 'Faq')

@section('specific')
<!-- Stili relativi alle faq -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/faq.css') }}" >
<script src="{{ asset('js/faq.js') }}"></script>
@endsection

<!-- Sezione centrale della pagina delle faq -->
@section('content')
@can('isAdmin')
<div id="New_Container">
    <a href="{{ route('form_faq') }}">
        <button><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Crea f.a.q. </button>
    </a>
</div>
@endcan
@if(session('message'))
<div class="message">{{session('message')}}</div>
@endif
@if(session('error'))
<div class="error">{{session('error')}}</div>
@endif
<section id="Faq_Container">
    <p class="Title">
        F.A.Q.
    </p>
    <div id="Faqs">
        @foreach($faq as $single_faq)
        <div class="Faq">
            @can('isAdmin')
            <div id="Button_Container">
                <a class="Button" href="{{ route('modifica_faq', [$single_faq->faqId]) }}">
                   <button type="submit"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></button>
                </a>
                <a class="Button" onclick="return conferma();" href="{{ route('elimina_faq', [$single_faq->faqId]) }}">
                    <button type="submit"><i class="fa fa-trash fa-lg"></i></button>
                </a>
            </div>
            @endcan
            <h3>{{ $single_faq->domanda }}</h3>

            <p>{{ $single_faq->risposta }}</p>
        </div>
        @endforeach
    </div>       
</section>
@endsection  