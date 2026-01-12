<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public $show = false;
    public string $title = 'Are you sure?';
    public string|null $subtitle = null;
    public $eventToEmit = '';
    public array $data = [];

    #[On('confirm')]
    public function triggerConfirmDialog(string $eventToEmit, string $title = 'Are you sure?', string $subtitle = '', array $data = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->eventToEmit = $eventToEmit;
        $this->data = $data;
        $this->show = true;
    }

    public function confirm()
    {
        $this->dispatch($this->eventToEmit, ...$this->data);
        $this->show = false;
    }

    public function cancel()
    {
        $this->show = false;
    }
};
?>

<div>
    @volt('confirm-modal')
        <div x-data="{
            show: false,
            wireShow: @entangle('show'),
            init() {
                $watch('wireShow', (value, oldValue) => {
                    setTimeout(() => {
                        this.show = value;
                    }, 300);
                });
        
            }
        
        }" x-on:confirm.window='show= true'>


            <x-big-loading-screen x-show='show' style="display: none" />


            <x-modal wire:model="show" :$title :$subtitle>

                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.show  = false" />
                    <x-button label="Confirm" wire:click='confirm' spinner class="btn-primary" />
                </x-slot:actions>
            </x-modal>
        </div>
    @endvolt
</div>
