<?php

use App\Models\Conversation;
use Livewire\Volt\Component;

new class extends Component {
    public $id;

    function mount()
    {
        $id = request('id');

        $this->id = $id;

        $conversation = Conversation::find($this->id);

        if (!$conversation) {
            abort(404);
        }
    }

    function with()
    {
        $conversation = Conversation::find($this->id);

        return compact('conversation');
    }
};
?>

<x-app-layout title="Edit conversation">
    @volt('conversation.edit')
        <div>
            <livewire:conversation :$id :model="null" :currentPageUrl="null" :users="[]" />
        </div>
    @endvolt
</x-app-layout>
