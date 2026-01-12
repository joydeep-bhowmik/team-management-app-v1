@props(['title' => null, 'cols' => 1])
<div {{ $attributes }}>
    <div wire:loading.class='disabled'>
        @if ($title)
            <x-header :$title>
                @isset($action)
                    <x-slot:actions>
                        {{ $action }}
                    </x-slot:actions>
                @endisset
            </x-header>
        @endif

        @if ($cols === 1)
            <div class="space-y-5">{{ $slot }}</div>
        @endif

        @if ($cols === 2)
            <div class="grid-cols-2 gap-5 space-y-5 md:grid md:space-y-0">{{ $slot }}</div>
        @endif

        @if ($cols === 3)
            <div class="grid-cols-3 gap-5 space-y-5 md:grid md:space-y-0">{{ $slot }}</div>
        @endif

        @if ($cols === 'form')
            <div class="grid-cols-[auto_300px] gap-5 space-y-5 md:grid md:space-y-0">{{ $slot }}</div>
        @endif
    </div>
</div>
