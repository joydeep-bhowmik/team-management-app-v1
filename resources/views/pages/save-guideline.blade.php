<?php

use Mary\Traits\Toast;
use App\Models\Guideline;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads, Toast;
    public $documents;
    public $version;

    function save()
    {
        $this->validate([
            'documents.*' => 'required|file|max:1024|mimes:pdf',

            'version' => 'required|unique:guidelines,version',
        ]);

        $guideline = new Guideline();

        $guideline->version = $this->version;

        if ($guideline->save()) {
            if ($this->documents) {
                foreach ($this->documents as $document) {
                    $guideline->addMedia($document)->toCollection('guidelines');
                }
            }
        }
    }
    #[On('delete')]
    public function delete(string $id)
    {
        $guideline = Guideline::find($id);

        if ($guideline && $guideline->created_at->isToday()) {
            $guideline->delete();

            $this->success('Guideline deleted successfully.');
        } else {
            $this->success('Cannot delete guideline. It was not created today.');
        }
    }

    function dispatchDelete(string $id)
    {
        $this->dispatch('confirm', eventToEmit: 'delete', data: [$id]);
    }
    function with()
    {
        $guidelines = Guideline::latest()->paginate();

        return compact('guidelines');
    }
};
?>
<x-app-layout title='Guidelines'>


    @volt('documents')
        <div>
            <x-header title='Guidelines'>
                @if (auth()->user()->isAdmin())
                    <x-slot:actions>
                        <x-button wire:click="save" class="btn-primary" spinner>Save</x-button>
                    </x-slot:actions>
                @endif
        </div>

        </x-header>
        <x-card title=" ">

            @if (auth()->user()->isAdmin())
                <div class="space-y-5">
                    <x-input label='Version' wire:model='version' />
                    <x-file wire:model='documents' label='Documents' multiple />
                </div>
            @endif

            <div class="space-y-5 mt-5  p-3">

                @forelse ($guidelines as $guideline)
                    <x-card>
                        <x-slot:title>
                            <h3 class="font-bold text-xl">Guideline - {{ $guideline->version }}</h3>
                        </x-slot:title>
                        @if (auth()->user()->isAdmin() && $guideline->created_at->isToday())
                            <x-slot:menu>
                                <x-button icon='o-trash' wire:click="dispatchDelete(`{{ $guideline->id }}`)"
                                    class="text-error" spinner />
                            </x-slot:menu>
                        @endif
                        @php
                            $documents = $guideline->media('guidelines')->get()->unique();

                        @endphp

                        <div class="mt-5 divide-y">
                            @foreach ($documents as $document)
                                <x-button :link="$document->getUrl()" external download icon='o-document' :label="$document->original_file_name" />
                            @endforeach
                        </div>
                    </x-card>
                @empty
                    <center>No guidelines uploaded yet</center>
                @endforelse
            </div>

            <div class="mt-5">
                {{ $guidelines->links() }}
            </div>
        </x-card>


        <x-big-loading-screen wire:loading wire:target='documents' />



        </div>
    @endvolt
</x-app-layout>
