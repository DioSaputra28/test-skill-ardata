<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'Admin Dashboard'))</title>
    
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body
    x-data="{ 
        page: '@yield('page', 'dashboard')', 
        'loaded': true, 
        'darkMode': false, 
        'stickyMenu': false, 
        'sidebarToggle': false, 
        'scrollTop': false 
    }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">
    
    {{-- Preloader --}}
    @include('admins.components.preloader')

    {{-- Main Wrapper --}}
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('admins.layouts.sidebar')

        {{-- Content Area --}}
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            {{-- Mobile Overlay --}}
            @include('admins.components.overlay')

            {{-- Header --}}
            @include('admins.components.header')

            {{-- Main Content --}}
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
</body>

</html>
