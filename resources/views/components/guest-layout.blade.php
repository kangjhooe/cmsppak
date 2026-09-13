<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Favicon -->
        @php
            $faviconUrl = ($profile && $profile->favicon) ? asset('storage/' . $profile->favicon) : asset('favicon.ico');
            $faviconPng = ($profile && $profile->favicon) ? asset('storage/' . $profile->favicon) : asset('favicon-256x256.png');
        @endphp
        <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
        @if($profile && $profile->favicon)
            <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
        @else
            <link rel="icon" type="image/svg+xml" href="{{ asset("favicon.svg") }}">
            <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("favicon-16x16.png") }}">
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("favicon-32x32.png") }}">
            <link rel="icon" type="image/png" sizes="48x48" href="{{ asset("favicon-48x48.png") }}">
            <link rel="icon" type="image/png" sizes="64x64" href="{{ asset("favicon-64x64.png") }}">
            <link rel="icon" type="image/png" sizes="128x128" href="{{ asset("favicon-128x128.png") }}">
            <link rel="icon" type="image/png" sizes="256x256" href="{{ asset("favicon-256x256.png") }}">
        @endif
        
        <!-- Apple Touch Icon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconPng }}">
        
        <!-- Android Chrome -->
        <link rel="icon" type="image/png" sizes="192x192" href="{{ $faviconPng }}">
        
        <!-- Web App Manifest -->
        <link rel="manifest" href="{{ asset("site.webmanifest") }}">
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
