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
    Alpine.store('wrapState', {
        // Lee el valor guardado en localStorage; si no existe, asigna un valor por defecto (por ejemplo, true).
        wrap: localStorage.getItem('wrap') === 'true' || true,
    });
});
</script>
