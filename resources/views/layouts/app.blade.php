<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SVAM') }}</title>
        <link rel="shortcut icon" href="{{ asset('fotos/favicon.webp') }}">

        {{-- SEO --}}
        <meta name="robots" content="index, follow">
        <meta name="title" content="ESPOCHEP-URS-2023">
        <meta name="author" content="ESPOCHEP">
        <meta name="description" content="Proyecto Levantamiento de Informacion 2023 Registro Social">
        <!-- Open Graph data -->
        <meta property="og:title" content="ESPOCHEP-URS-2023">
        <meta property="og:type" content="article">
        <meta property="og:description" content="ESPOCHEP, es una empresa dedicada a las compras publicas">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:img" content="{{ asset('fotos/portada_3.webp') }}">
        <meta property="og:site_name" content="ESPOCHEP-URS-2023"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <x-footer/>
        </div>
        @stack('modals')
        @livewireScripts
    </body>
</html>
