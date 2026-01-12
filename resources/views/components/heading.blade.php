@props(['title'])
<div class="flex flex-col flex-wrap gap-5 lg:flex-row">

    <div>
        <h2 class="text-3xl font-bold"> {{ $title }}</h2>
    </div>
    <div class="ml-auto">
        {{ $slot }}
    </div>
</div>
