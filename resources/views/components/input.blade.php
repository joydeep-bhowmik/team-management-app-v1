@props(['id' => 'input-' . uniqid(), 'name', 'label'])
<x-input-container>
    @if ($label)
        <x-input-label for="{{ $id }}" :value="__($label)" />
    @endif
    <x-text-input
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full',
            'id' => $id,
            'name' => $name,
            'wire:model' => $name,
        ]) }} />
    <x-input-error class="mt-2" :messages="$errors->get($name)" />
</x-input-container>
