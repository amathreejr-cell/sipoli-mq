<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPOLI-MQ') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false }">

    <!-- Sidebar -->
    @include('layouts.navigation')


    <!-- Main Application -->
    <div class="min-h-screen lg:ml-64">

        <!-- Top Header -->
        <header class="sticky top-0 z-30 h-16 bg-white border-b border-slate-200">

            <div class="h-full px-4 sm:px-6 flex items-center justify-between">

                <!-- Mobile Menu Button -->
                <button type="button" @click="sidebarOpen = true"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-slate-600 hover:bg-slate-100 transition"
                    aria-label="Buka menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>


                <!-- Brand / Context -->
                <div class="hidden sm:block">

                    <p class="text-xs text-slate-400">
                        Sistem Informasi Poliklinik
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        Madrasatul Qur'an
                    </p>

                </div>


                <!-- User -->
                <div class="ml-auto flex items-center gap-3">

                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-medium text-slate-700">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>

                    </div>


                    <div
                        class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                </div>

            </div>

        </header>


        <!-- Page Heading -->
        @isset($header)
            <div class="bg-white border-b border-slate-200">

                <div class="px-4 sm:px-6 lg:px-8 py-5">

                    {{ $header }}

                </div>

            </div>
        @endisset


        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">

            <!-- Success -->
            @if (session('success'))
                <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif


            <!-- Error -->
            @if (session('error'))
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif


            {{ $slot }}

        </main>

    </div>

</body>

</html>
