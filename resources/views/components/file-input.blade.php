@props(['wire:model', 'label' => null, 'media'])



<?php

use Livewire\Volt\Component;
use JoydeepBhowmik\LaravelMediaLibary\Models\Media;

new class extends Component {
    public $model;

    public string $media;

    function mount($media, $model = null)
    {
        $this->model = $model ?? auth()->user();

        $this->media = $media;
    }
    function delete(string $id)
    {
        $media = Media::find($id);

        $media?->delete();
    }
};
?>

<div>
    <x-file :wire:model="$attributes->whereStartsWith('wire:model')->first()" :$label />

    @volt('file-input')
        <div>
            @php

                $file = $model->getFirstMedia($media);

            @endphp
            @if ($file)
                <div class="flex items-center gap-2" wire:loading.class='opacity-55'>

                    <x-button class="mt-1" icon='o-document' :link='$file->getUrl()'>
                        <x-slot:label>
                            <span class="truncate">{{ $file?->original_file_name }}</span>
                        </x-slot:label>
                    </x-button>
                    <x-button icon='o-trash' wire:confirm='Are you sure?' wire:click='delete(`{{ $file->id }}`)' />
                </div>
            @endif
        </div>
    @endvolt

</div>
