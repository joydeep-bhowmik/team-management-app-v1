@props(['title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.24.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.24.0/firebase-messaging.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.css"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $user = auth()->user();
@endphp

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200" x-data="{

    title: ``,
    count: {{ $user->unreadNotifications->count() }},

    setTitle() {
        this.title = this.count ? `(${this.count}) {{ $title ?? config('app.name') }}` : `{{ $title }}`;
        document.title = this.title; // Corrected to use `this.title`
    }

    ,
    handleNotificationRecieved($event) {
        const { count } = $event.detail;
        this.count = count;
        this.setTitle();
    },
    init() {
        this.setTitle();

        $watch('title', (value) => {
            document.title = value
        })
    }

}"
    x-on:update-notification-count.window="handleNotificationRecieved"
    x-on:logout.window="window.location.href=`{{ route('logout') }}`">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden z-30">
        <x-slot:brand>
            <div class="ml-5 ">
                <a href="{{ route('dashboard') }}" x-navigate><x-application-logo class="h-8 dark:text-white" /></a>
            </div>
        </x-slot:brand>
        <x-slot:actions>

            <label for="main-drawer" class="lg:hidden mr-3 flex items-center gap-2">
                <x-theme-toggle class="mt-2" />
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <div class="ml-5 pt-5"><a href="{{ route('dashboard') }}"x-navigate> <x-application-logo
                        class="h-8 " /></a>
            </div>

            {{-- MENU --}}
            <x-menu activate-by-route class="ml-2">

                {{-- User --}}
                @if ($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item avatar='avatar_url' :item="$user" value="name" sub-value="email" no-separator
                        no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                no-wire-navigate x-data
                                @click="$dispatch('confirm',{eventToEmit:'logout',subtitle:'Are you sure to logout ? '})" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif
                <x-menu-item title="Hello" icon="o-sparkles" link="/" />
                <x-menu-item icon="o-moon" @click="$dispatch('mary-toggle-theme')">
                    <x-slot:title>
                        <span class="hidden dark:block">Theme - Dark</span>
                        <span class=" dark:hidden ">Theme - Light</span>
                    </x-slot:title>
                </x-menu-item>
                <x-menu-item title='Dashboard' icon="o-chart-pie" :link="route('dashboard')" />
                <x-menu-item title="Profile" icon="o-user-circle" :link="route('profile')" />
                <x-menu-item title="People" icon="o-user-group" :link="route('people')" />
                <x-menu-item title="My notes" icon='o-clipboard-document-list' :link="route('notes')" />
                <x-menu-item title="Guidelines" icon='o-newspaper' :link="route('guidelines.create')" />

                <x-menu-sub title="Tasks" icon='o-rectangle-stack'>
                    <x-menu-item title="Create" :link="route('tasks.create')" />
                    <x-menu-item title="All" :link="route('tasks.all')" />
                </x-menu-sub>

                <x-menu-sub title="Leave Applications" icon='o-document'>
                    <x-menu-item title="Create" :link="route('leaveApplications.create')" />
                    <x-menu-item title="All" :link="route('leaveApplications.all')" />
                </x-menu-sub>

                @if (auth()->user()->isAdmin())
                    <x-menu-sub title="Designations" icon='o-user'>
                        <x-menu-item title="Create" :link="route('designations.create')" />
                        <x-menu-item title="All" :link="route('designations')" />
                    </x-menu-sub>
                    <x-menu-sub title="Employees" icon='o-user-group'>
                        <x-menu-item title="Create" :link="route('employees.create')" />
                        <x-menu-item title="All" :link="route('employees.all')" />
                    </x-menu-sub>




                    <x-menu-sub title="Events" icon='o-calendar-days'>

                        <x-menu-item title="Create" :link="route('events.create')" />
                        <x-menu-item title="All" :link="route('events.all')" />
                    </x-menu-sub>
                @endif
                <x-menu-sub title="Attendences" icon='o-list-bullet'>
                    <x-menu-item title="Requests" :link="route('attendences.requests')" />
                    @if (auth()->user()->hasDesignation('frontdesk') || auth()->user()->isAdmin())

                        <x-menu-item title="Create" :link="route('attendences.create')" />
                        @if (auth()->user()->isAdmin())
                            <x-menu-item title="All" :link="route('attendences.all')" />
                        @endif

                    @endif

                </x-menu-sub>

                <x-notification-icon :onlybell="false" />

                <x-check-and-update-device-token />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>

            <div style="display: none" x-show="show" x-data="{
                show: false,
                handlePushNotification($event) {
                    const { value } = $event.detail;
                    this.show = value;
                }
            }"
                x-on:push-notification-status.window="handlePushNotification" class="mb-5">
                <x-alert title="Push notification is turned off" description="Please turn on you push notification"
                    icon="o-exclamation-triangle">
                    <x-slot:actions>

                        <x-push-notification-switch />
                    </x-slot:actions>
                </x-alert>

            </div>



            <div class="mx-auto max-w-7xl">
                {{ $slot }}
                <div class="h-96"></div>
                <div
                    class="fixed lg:rounded-md shadow-sm z-20 border lg:bottom-3  bottom-0 left-0 lg:left-auto right-0 lg:max-w-fit w-full  bg-white dark:bg-gray-950 px-3 py-2 lg:py-1">
                    <div class="grid-cols-5 grid justify-center gap-4  ">

                        <div>
                            <x-button x-data @click="history.back()" icon="o-arrow-long-left"
                                class="bg-transparent btn-circle border-0 shadow-none" />

                        </div>
                        <div class="grid place-items-center">
                            <x-button :link="route('dashboard')" icon="o-home"
                                class="bg-transparent btn-circle border-0 shadow-none" />
                        </div>

                        <div class="grid place-items-center">
                            <x-button :link="route('tasks.create')" icon="o-plus" title="Create Task"
                                class="bg-transparent border-0 btn-circle shadow-none" />
                        </div>
                        <div class="grid place-items-center">

                            <x-notification-icon onlybell />
                        </div>

                        <div>
                            <x-button x-data @click="history.forward()" icon="o-arrow-long-right"
                                class="bg-transparent btn-circle border-0 shadow-none" />

                        </div>
                    </div>
                </div>
            </div>


        </x-slot:content>

    </x-main>

    {{-- Toast --}}
    <x-toast position="toast-bottom toast-end" />
    <x-confirm-modal />

</body>

</html>
