<?php

use Mary\Traits\Toast;
use App\Models\Conversation;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Notifications\ConversationNotification;
use JoydeepBhowmik\LaravelMediaLibary\Models\Media;

new class extends Component {
    use WithFileUploads, Toast;

    public $body;

    public $model;

    public $attachments;

    public $audio;

    public $users;

    public $currentPageUrl;

    public $id;

    function mount($model, $currentPageUrl, array $users, string|nullable $id = null)
    {
        $this->model = $model;

        $this->users = $users;

        $this->currentPageUrl = $currentPageUrl;

        $this->id = $id;
    }

    function save()
    {
        $conversation = $this->id ? Conversation::find($this->id) : new Conversation();

        $conversation->body = $this->body;

        if (!$this->id) {
            $conversation->user_id = auth()->user()->id;

            $conversation->model_id = $this->model->id;

            $conversation->model_type = get_class($this->model);
        }

        if ($conversation->save()) {
            if ($this->attachments && is_array($this->attachments)) {
                foreach ($this->attachments as $attachment) {
                    $conversation->addMedia($attachment)->toCollection('attachments');
                }
            }

            if ($this->audio) {
                $conversation->addMedia($this->audio)->toCollection('audio');
            }

            if (!$this->id) {
                foreach ($this->users as $user) {
                    // 4$user->notify(new ConversationNotification(title: auth()->user()->name . ' replied to a conversation', body: '', action_link: $this->currentPageUrl . '' . '#convo-' . $conversation->id, badge: auth()->user()->avatar));
                    if ($user->id !== auth()->user()->id) {
                        $user->notify(new ConversationNotification(title: auth()->user()->name . ' replied to a conversation', body: '', action_link: $this->currentPageUrl . '' . '#convo-' . $conversation->id, badge: auth()->user()->avatar));
                    }
                }
            }

            $this->attachments = null;

            $this->success('Reply sent');
            
            $this->reset('body');
        }
    }

    function deleteMedia(string $id)
    {
        $media = Media::find($id);

        $media && $media->delete() && $this->success('File Deleted');
    }

    function delete(string $id)
    {
        $conversation = Conversation::find($id);

        if ($conversation && $conversation->user_id == auth()->user()->id) {
            $conversation->deleteAllMedia();

            $conversation->body = '*this conversation was deleted*';
            return $conversation->save();
        }

        return abort(403);
    }

    function with()
    {
        $conversations = Conversation::where('model_id', $this->model?->id)->get();

        $editable_conversation = Conversation::find($this->id);

        if ($this->id && !$editable_conversation) {
            abort(404);
        }

        if ($editable_conversation) {
            $this->body = $editable_conversation->body;
        }

        return compact('conversations', 'editable_conversation');
    }
};

?>

<div>

    <x-big-loading-screen wire:loading wire:target="attachments,audio" />

    <div wire.loading.class="opacity-55" class="mt-5" x-data="{
    
        init() {
            const hash = window.location.hash;
    
            // Check if the hash is non-empty
            if (hash) {
                const element = document.querySelector(hash);
    
    
                if (element) {
                    setTimeout(() => {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        element.style.backgroundColor = '#ccf2ff';
                    }, 500);
                }
            }
        }
    
    }">
        <div class="space-y-4">

            @php
                $Parsedown = new Parsedown();
            @endphp


            @if (!$editable_conversation)


                @foreach ($conversations as $conversation)
                    @php
                        $user = $conversation->user()->first();

                        $_attachments = $conversation->getMedia('attachments');

                        $audios = $conversation->getMedia('audio');
                    @endphp

                    <div class="border p-3 rounded-md" id='convo-{{ $conversation->id }}'>
                        <div class="flex items-center w-full ">
                            <div>
                                <x-avatar :image="$user?->avatar" :title="$user ? $user->name : 'Deleted User' . ' - ' . '#' . $conversation->id" :subtitle="$conversation->created_at->diffForHumans() .
                                    '  ' .
                                    ($conversation->created_at != $conversation->updated_at ? ' - Edited' : '')" class="!w-10" />

                            </div>
                            <div class="ml-auto">
                                @if ($conversation->user_id === auth()->user()->id)
                                    <x-dropdown icon='o-ellipsis-horizontal'
                                        class="!bg-transparent !border-0 !shadow-none">
                                        <x-menu-item title="Edit" icon="o-pencil" :link="route('conversations.edit', $conversation->id)" />
                                        <x-menu-item title="Remove" wire:confirm="Are you sure?"
                                            wire:click="delete(`{{ $conversation->id }}`)" icon="o-trash" />
                                    </x-dropdown>
                                @endif
                            </div>

                        </div>
                        <div class="ml-10 mt-3 prose">{!! $Parsedown->text($conversation->body) !!}</div>

                        <div class="space-y-2 mt-3">
                            @foreach ($_attachments as $attachment)
                                <x-button icon='o-document-text' class="btn-outline" :label="$attachment->original_file_name" :link='$attachment->getUrl()'
                                    external />
                            @endforeach

                            @foreach ($audios as $attachment)
                                <audio src="{{ $attachment->getUrl() }}" class="w-full" controls />
                            @endforeach
                        </div>


                    </div>
                @endforeach
            @endif
        </div>
        <div class="mt-5">
            @if ($editable_conversation)
                <x-button icon='o-chat-bubble-left-right' :link="route('tasks.view', $editable_conversation->model_id) .
                    '#convo-' .
                    $editable_conversation->id">View conversation</x-button>
            @endif

            @php
                $config = [
                    'spellChecker' => true,
                    'toolbar' => [
                        'heading',
                        'bold',
                        'italic',
                        'strikethrough',
                        'unordered-list',
                        'ordered-list',
                        '|',
                        'preview',
                    ],
                    'maxHeight' => '200px',
                ];
            @endphp

            <div class="mt-5">
                <x-markdown wire:model='body' class="min-h-24 " :$config />
            </div>

            <div class="flex items-center gap-5">
                <div class="w-fit ">
                    <x-button spinner class="btn-primary" wire:click='save'>Send</x-button>
                </div>
                <div class="w-fit cursor-pointer">

                    <label for="Attachments" class="block cursor-pointer">
                        <x-icon name='o-paper-clip' />
                    </label>
                    <input type="file" id="Attachments" class="hidden" wire:model.live='attachments' multiple>


                </div>

                <div class="w-full">
                    <x-audio-recorder wire:model='audio' />

                </div>
            </div>

            @error('audio')
                <x-errors :title="$message" description="Please, fix them." icon="o-face-frown" />
            @enderror

            @error('attachments')
                <x-errors :title="$message" description="Please, fix them." icon="o-face-frown" />
            @enderror


            <div>
                <div class="space-y-5">
                    @if ($attachments)


                        @foreach ($attachments as $attachment)
                            <div>
                                <x-button icon='o-document-text' class="btn-outline mt-5" :label="$attachment->getClientOriginalName()" />
                            </div>
                        @endforeach

                    @endif

                    @if ($editable_conversation)
                        @php
                            $editable_attachments = $editable_conversation->getMedia('attachments');
                            $editable_audios = $editable_conversation->getMedia('audio');
                        @endphp

                        @foreach ($editable_attachments as $attachment)
                            <div class="flex items-center">
                                <x-button icon="o-trash" wire:confirm='Are you sure?'
                                    wire:click='deleteMedia(`{{ $attachment->id }}`)' />
                                <x-button icon='o-document-text' class="btn-outline" :label="$attachment->original_file_name"
                                    :link='$attachment->getUrl()' external />
                            </div>
                        @endforeach

                        @foreach ($editable_audios as $attachment)
                            <div class="flex items-center">
                                <x-button icon="o-trash" wire:confirm='Are you sure?'
                                    wire:click='deleteMedia(`{{ $attachment->id }}`)' />
                                <audio src="{{ $attachment->getUrl() }}" class="w-full" controls />
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
