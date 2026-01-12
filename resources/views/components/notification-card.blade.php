@props(['icon' => 'o-bell', 'timeAgo' => '2 hours ago', 'read' => false])

@php
    $target = $attributes->whereStartsWith('wire:click')->first();
@endphp
<div {{ $attributes->merge(['class' => 'w-full p-3  rounded flex cursor-pointer ' . (!$read ? 'bg-white  dark:bg-gray-700' : ' ')]) }}
    wire:loading.class="animate-pulse" wire:target="{{ $target }}" x-data
    @click="$el.style.backgroundColor='transparent'">

    <div tabindex="0" aria-label="heart icon" role="img"
        class="focus:outline-none w-8 h-8 border rounded-full flex items-center justify-center">
        <x-icon :name='$icon' />
    </div>
    <div class="pl-3">
        <p tabindex="0" class="focus:outline-none text-sm leading-none">
            {{ $slot }}
        </p>
        <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">
            {{ $timeAgo }}
        </p>
    </div>
</div>
