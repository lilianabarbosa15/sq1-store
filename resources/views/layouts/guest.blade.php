<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;500;700&family=Jost:wght@400;700&family=Volkhov:wght@400;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="min-h-screen min-w-full bg-white font-sans antialiased flex flex-col">
        @props(['navBackground' => 'bg-neutral-50'])
        
        <x-global.header :navBackground="$navBackground" />

        {{ $slot }}
        
        <aside id="aside-modal"></aside>
        @livewireScripts
    </body>
</html>

<script>
    document.addEventListener('alpine:init', () => {
        // Create a global store for the wrap state
        Alpine.store('wrapState', { wrap: false });
    });
</script>
