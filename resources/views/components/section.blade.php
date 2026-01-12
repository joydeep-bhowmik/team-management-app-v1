@props(['name'])
<section {{ $attributes->merge(['class' => 'break-inside-avoid-column bg-white  border rounded-2xl']) }}>
    @isset($name)
        <header class="flex flex-wrap items-center gap-2 border-b p-3 text-xs uppercase tracking-wider">
            <div>
                {{ $name }}
            </div>
            @isset($actions)
                <div class="ml-auto w-fit">{{ $actions }}</div>
            @endisset

        </header>
    @endisset
    <article class="p-3"> {{ $slot }}</article>
</section>
