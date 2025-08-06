<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Table Booking' }}</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @stack('styles')
    </head>
    <body class="h-full">
        {{-- Main content --}}
        {{ $slot }}
    </body>
</html>
