@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Onboarding - {{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.css"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


@php
    $onboarding = auth()->user()->onboarding();

    $percentageComplete = $onboarding->steps->count() ? $onboarding->percentageCompleted() : 0;
@endphp


<body class="font-sans  antialiased ">

    <div class="p-3 mx-auto lg:ml-0 w-fit">
        <a href="/" wire:navigate>
            <x-application-logo class="h-10 fill-current dark:text-white" />
        </a>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center   s">


        <div class="block lg:hidden">

            <x-progress-radial :class="match (true) {
                $percentageComplete >= 75 => 'bg-green-500 text-green-100 border-green-600',
                $percentageComplete >= 50 => 'bg-yellow-500 text-yellow-100 border-yellow-600',
                $percentageComplete >= 25 => 'bg-orange-500 text-orange-100 border-orange-600',
                default => 'bg-red-500 text-red-100 border-red-600',
            } . ' mx-auto  ml-5'" :value="$percentageComplete" />
        </div>


        <div class="w-full grid grid-cols-1 lg:grid-cols-[250px_500px_auto] gap-5 p-5   mx-auto mt-8">





            <div>

                <div class="p-3 lg:block hidden">
                    <x-timeline-item title="Start" first icon='o-user' />


                    @foreach ($onboarding->steps as $step)
                        <a href="{{ $step->link }}" x-navigate>
                            <x-timeline-item :title="$step->title" :pending="!$step->complete()" />
                        </a>
                    @endforeach

                    <x-timeline-item title="Finished" icon="o-check" :pending="!$onboarding->finished()" last />


                    @if ($onboarding->nextUnfinishedStep())
                        <x-redirect-unfinished-step />
                    @endif
                </div>

                <div class="lg:hidden block">
                    <x-collapse>
                        <x-slot:heading>
                            Onboading
                        </x-slot:heading>
                        <x-slot:content>
                            <div class="p-3">
                                <x-timeline-item title="Start" first icon='o-user' />


                                @foreach ($onboarding->steps as $step)
                                    <a href="{{ $step->link }}" x-navigate>
                                        <x-timeline-item :title="$step->title" :pending="!$step->complete()" />
                                    </a>
                                @endforeach

                                <x-timeline-item title="Finished" icon="o-check" :pending="!$onboarding->finished()" last />


                                @if ($onboarding->nextUnfinishedStep())
                                    <x-button class="mt-5" :link="$onboarding->nextUnfinishedStep()->link">Next Unfinished Step</x-button>
                                @endif
                            </div>
                        </x-slot:content>
                    </x-collapse>
                </div>

            </div>

            <div>
                {{ $slot }}


            </div>

            <div>

                <div class="lg:block hidden">
                    <label for="" class="font-bold text-lg">Progress</label>
                    <x-progress-radial :class="match (true) {
                        $percentageComplete >= 75 => 'bg-green-500 text-green-100 border-green-600',
                        $percentageComplete >= 50 => 'bg-yellow-500 text-yellow-100 border-yellow-600',
                        $percentageComplete >= 25 => 'bg-orange-500 text-orange-100 border-orange-600',
                        default => 'bg-red-500 text-red-100 border-red-600',
                    } . ' mx-auto size-40 ml-5'" :value="$percentageComplete" />

                </div>
            </div>
        </div>
        {{-- Toast --}}
        <x-toast />
</body>

</html>
