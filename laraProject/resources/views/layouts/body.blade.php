<!DOCTYPE html>
<!-- Definisce il layout di base del sito -->
<html>
    <head>
        <title>TicketMania | @yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" >
        <!-- Stili e script specifici alla sezione centrale -->
        @yield('specific')
        <!-- Stili presi dal web -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body id="Body">
        @include('layouts.navbar')
        <!-- Inserisce la sezione centrale -->
        @yield('content')
        @include('layouts.footer')
    </body>
</html>

