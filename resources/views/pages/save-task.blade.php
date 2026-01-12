<?php
use App\Models\Task;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Notifications\TaskNotification;
use JoydeepBhowmik\LaravelMediaLibary\Models\Media;

new class extends Component {
    use Toast, WithFileUploads;

    public $id;
    public $title;
    public $description;
    public $assigned_to;
    public $due_date;
    public $priority;
    public string $status = 'pending';
    public $attachments = [];
    public $audio;

    function mount()
    {
        $id = request('id');

        $assignee_id = request('assignee');

        $this->assigned_to = $assignee_id;

        if (!$id) {
            return;
        }

        $task = Task::find($id);

        if ($id && !$task) {
            return abort(404);
        }

        if ($task->assigner_id != auth()->user()->id) {
            return abort(403);
        }

        $this->id = $id;

        $this->title = $task->title;

        $this->description = $task->description;

        $this->assigned_by = $task->assigner_id;

        $this->assigned_to = $task->assignee_id;

        $this->due_date = $task->due_date->format('Y-m-d');

        $this->priority = $task->priority;

        $this->status = $task->status;
    }

    function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => [
                'required',
                'integer',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    // Get the authenticated user
                    $user = auth()->user();

                    if ($user->id === (int) $value) {
                        return;
                    }

                    // Fetch assignable designations as an array
                    $assignableDesignations = $user->designation()->first()?->assignableDesignations()->get()->pluck('id')->toArray() ?? [];

                    // Get the assignee's designation
                    $assignee = User::find($value);

                    if (!$assignee) {
                        $fail('The selected user does not exist.');
                        return;
                    }

                    $assigneeDesignation = $assignee->designation()->first()?->id ?? null;

                    // Explicitly handle null values
                    if ($assigneeDesignation === null || empty($assignableDesignations)) {
                        $fail('You are not allowed to assign tasks to this user.');
                        return;
                    }

                    // Check if the assignee's designation is assignable
                    if (!in_array($assigneeDesignation, $assignableDesignations)) {
                        $fail('You are not allowed to assign tasks to this user.');
                    }
                },
            ],
            'due_date' => $this->id
                ? [
                    'nullable',
                    'date',
                    function ($attribute, $value, $fail) {
                        $task = Task::find($this->id);
                        if ($task && \Carbon\Carbon::parse($value)->startOfDay() < $task->created_at->startOfDay()) {
                            $fail('The due date cannot be earlier than the task creation date.');
                        }
                    },
                ]
                : 'required|date|after_or_equal:today',

            'priority' => 'required|string|in:low,medium,high',
            'status' => 'nullable|string|in:pending,cancelled,completed',
            'audio' => 'nullable|file|mimes:webm,mp3,wav,ogg|max:10240',
        ]);

        // assignableDesignations

        $user = auth()->user();

        $task = $this->id ? Task::find($this->id) : new Task();

        $task->title = $this->title;

        $task->description = $this->description;

        $task->assigner_id = $user->id;

        $task->assignee_id = $this->assigned_to;

        $task->due_date = $this->due_date;

        $task->priority = $this->priority;

        $task->status = $this->status;

        if ($task->save()) {
            if ($this->attachments && is_array($this->attachments)) {
                foreach ($this->attachments as $attachment) {
                    $task->addMedia($attachment)->toCollection('attachments');
                }
            }

            if ($this->audio) {
                $task->addMedia($this->audio)->toCollection('audio');
            }
            $assignee = User::find($task->assignee_id);

            !$this->id && $assignee->notify(new TaskNotification($task));
            $this->attachments = [];
            $this->success(title: 'Task Saved', description: 'Task saved successfully');

            if (!$this->id) {
                $this->redirect(route('tasks.view', $task->id), navigate: true);
            }
        }
    }

    function with()
    {
        $users = User::with('designation')->get();

        $task = Task::find($this->id);

        $groupedUsers = $users
            ->groupBy(fn($user) => $user->designation?->name ?? 'No Designation')
            ->map(function ($users, $designation) {
                return $users
                    ->map(function ($user) use ($designation) {
                        return [
                            'id' => $user->id,
                            'name' => "{$user->name} - #{$user->uniqid} - {$designation}",
                        ];
                    })
                    ->toArray();
            })
            ->toArray();

        return compact('users', 'groupedUsers', 'task');
    }
    #[On('show-confirm-modal-isconfirmed')]
    function test()
    {
        dd(1);
    }

    function deleteMedia(string $id)
    {
        $media = Media::find($id);

        $media && $media->delete() && $this->success('File Deleted');
    }
    #[On('deleteTask')]
    function Delete()
    {
        $task = Task::find($this->id);

        if ($task?->delete()) {
            $this->success('deleted');
            $this->redirect(route('tasks.all'), navigate: true);
        }
    }
};

?>

<x-app-layout>



    @volt('save-task-volt')
        <div>
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
            <x-slot:title>{{ ($id ? 'Edit' : 'Create') . ' Task' }}</x-slot:title>


            @if ($id && $task?->status && $task->status === 'cancelled')

                <x-alert title="Task was cancelled" description="Cant edit a cancelled task ! create a new one"
                    icon="o-information-circle" class="alert-warning" />
            @else
                <x-confirm-modal name='test-modal' />
                <x-layout :title="($id ? 'Edit' : 'Create') . ' Task'" :cols='1'>

                    <x-slot name="action">
                        @if ($id)
                            <x-button class="!bg-red-500 text-white" x-data
                                @click="$dispatch('confirm',{subtitle:`This action can't be undone`,eventToEmit:`deleteTask`})">Delete</x-button>
                        @endif

                        <x-button wire:click='save' spinner>Save</x-button>
                    </x-slot>


                    <x-layout :cols="2">
                        <x-input wire:model='title' label='Title' />

                        <x-select-group label="Assignee" placeholder="Select" :value="$assigned_to" :options="$groupedUsers"
                            wire:model="assigned_to" />
                    </x-layout>

                    <x-markdown wire:model='description' label='Description' class="z-50" :$config />




                </x-layout>

                <x-layout :cols='2'>
                    <x-radio label='Priority' wire:model='priority' :options="[
                        [
                            'id' => 'low',
                            'name' => 'Low',
                        ],
                        [
                            'id' => 'medium',
                            'name' => 'Mid',
                        ],
                        [
                            'id' => 'high',
                            'name' => 'High',
                        ],
                    ]" />


                    @if ($id)
                        <x-radio label='Status' wire:model='status' :options="[
                            [
                                'id' => 'pending',
                                'name' => 'Pending',
                            ],
                            [
                                'id' => 'completed',
                                'name' => 'Completed',
                            ],
                            [
                                'id' => 'cancelled',
                                'name' => 'Cancelled',
                            ],
                        ]" />
                    @endif

                    <x-datetime label="Due date" wire:model="due_date" icon="o-calendar" />







                </x-layout>
                <x-layout :cols='2' class="mt-3">


                    <div>


                        <x-file label="Attachments" wire:model='attachments' multiple />




                        <div>
                            @foreach ($attachments as $attachment)
                                <div class="space-y-5">
                                    @php
                                        $name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME);
                                        $extension = pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION);
                                        $truncatedName = Str::limit($name, 15, '...') . '.' . $extension;
                                    @endphp
                                    <x-button icon='o-document-text' class="btn-outline mt-5" :label="$truncatedName" />
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-5 mt-5">
                            @if ($task)
                                @foreach ($task->getMedia('attachments') as $attachment)
                                    <div class="flex items-center gap-2">
                                        @php
                                            $name = pathinfo($attachment->original_file_name, PATHINFO_FILENAME);
                                            $extension = pathinfo($attachment->original_file_name, PATHINFO_EXTENSION);
                                            $truncatedName = Str::limit($name, 15, '...') . '.' . $extension;
                                        @endphp
                                        <x-button icon='o-document-text' class="btn-outline" :label="$truncatedName"
                                            :link='$attachment->getUrl()' external />
                                        <x-button icon="o-trash" wire:confirm='Are you sure?'
                                            wire:click='deleteMedia(`{{ $attachment->id }}`)' />
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>

                    <div>
                        <label for="" class="font-medium">Audio</label>
                        <div class=" mt-3 rounded-md border">

                            <x-audio-recorder wire:model='audio' />
                            @error('audio')
                                <x-errors :title="$message" description="Please, fix them." icon="o-face-frown" />
                            @enderror



                            <div class="space-y-5 mt-5">
                                @if ($task)
                                    @foreach ($task?->getMedia('audio') as $attachment)
                                        <div class="flex items-center gap-2">
                                            <x-button icon="o-trash" wire:confirm='Are you sure?'
                                                wire:click='deleteMedia(`{{ $attachment->id }}`)' />
                                            <audio src="{{ $attachment->getUrl() }}" class="w-full" controls />

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </x-layout>

            @endif


        </div>
    @endvolt
</x-app-layout>
