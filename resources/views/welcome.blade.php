<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.css" rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased font-sans">
    <section class="container mx-auto px-8 py-36 text-center sm:px-12">
        <div class="max-w-2xl mx-auto">

            <center><x-application-logo class="h-20" /></center>

            <h1 class="mb-12 text-5xl font-extrabold mt-5 leading-tight dark:text-slate-50 sm:text-6xl">
                Welcome to {{ env('APP_NAME') }} team
            </h1>
            <p class="mb-12 leading-relaxed text-slate-700 dark:text-slate-400">
                You are a valuable member of our organization
            </p>
        </div>
        <div class="mx-auto flex w-fit flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
            @if (!auth()->user())
                <x-button :link="route('register')" x-navgate class="btn-primary">
                    Register
                </x-button>
                <x-button :link="route('login')" x-navgate>
                    Login
                </x-button>
            @else
                <x-button :link="route('dashboard')">
                    Dashboard
                </x-button>
            @endif
        </div>
    </section>
</body>
@livewireScripts

</html>
