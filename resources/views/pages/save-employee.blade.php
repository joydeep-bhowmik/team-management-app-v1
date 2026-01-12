<?php
use App\Models\Task;
use App\Models\User;
use Mary\Traits\Toast;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\UserDesignation;

new class extends Component {
    use Toast, WithFileUploads;
    public $id;
    public $name;
    public $avatar;
    public $email;
    public $phone_number;
    public $whatsapp_number;
    public $password;
    public $avatar_src;
    public $date_of_joining;
    public $salary;

    public $note;
    public $job_designation;
    public $role;
    public $roles = ['admin', 'employee', 'suspended']; // Default roles array
    public $title;
    public $showDeleteModal;

    function mount()
    {
        $id = request('id');

        $user = User::find($id);

        $this->title = ($user ? 'Edit' : 'Create') . ' Employee ' . ($user ? $user->name : '');

        if (!$user) {
            return;
        }

        $this->id = $user->id;

        $this->name = $user->name;

        $this->email = $user->email;

        $this->phone_number = $user->phone_number;

        $this->whatsapp_number = $user->whatsapp_number;

        $this->password = $user->password;

        $this->avatar_src = $user->getUrl('avatar');

        $this->date_of_joining = $user->joining_date;

        $this->salary = $user->salary;

        $this->note = $user->note;

        $this->job_designation = $user->user_designation_id;

        $this->role = $user->role;
    }

    function save()
    {
        if ($this->job_designation === '') {
            $this->job_designation = null;
        }

        $user = $this->id ? User::find($this->id) : new User();

        if (!$user) {
            return;
        }

        $this->validate([
            'name' => 'required',
            'avatar' => 'nullable|image|max:1024',
            'email' => 'required|unique:users,email,' . $this->id,
            'phone_number' => 'nullable|regex:/^[0-9]{10}$/',
            'whatsapp_number' => 'nullable|regex:/^[0-9]{10}$/',
            'password' => 'required',
            'salary' => 'nullable',
            'date_of_joining' => 'nullable|date',
            'note' => 'nullable',
            'job_designation' => 'nullable',
            'role' => 'nullable|in:' . join(',', $this->roles),
        ]);

        $user->name = $this->name;

        if ($this->avatar) {
            $user->deleteMediaCollection('avatar');

            $user->addMedia($this->avatar)->toCollection('avatar');
        }

        $user->email = $this->email;

        $user->phone_number = $this->phone_number;

        $user->whatsapp_number = $this->whatsapp_number;

        $user->password = $this->password;

        $user->joining_date = $this->date_of_joining;

        $user->salary = $this->salary;

        $user->note = $this->note;

        $user->user_designation_id = $this->job_designation;

        $user->role = $this->role;

        if ($user->save()) {
            $this->success('Saved');

            if ($this->id) {
                return;
            }
            $this->redirect(route('employees.edit', $user->id), navigate: true);
        }
    }
    function delete_image()
    {
        $user = User::find($this->id);

        if (!$user) {
            return;
        }

        $user->remove('avatar');

        $user->save();
    }

    #[On('deleteEmployee')]
    function delete()
    {
        $user = User::find($this->id);

        if (!$user) {
            return;
        }

        if ($user->delete()) {
            $this->success('Employee deleted');

            $this->redirect(route('employees.all'), navigate: true);
        }
    }

    function with()
    {
        $user = User::find($this->id);

        $pending_tasks = Task::where('assignee_id', $this->id)->where('status', 'pending')->count();

        $completed_tasks = Task::where('assignee_id', $this->id)->where('status', 'completed')->count();

        $designations = UserDesignation::all()->toArray();

        return compact('user', 'pending_tasks', 'completed_tasks', 'designations');
    }
};

?>

<x-app-layout>

    @volt('save-employee')
        <div>

            <x-slot:title>{{ $title }}</x-slot:title>
            <x-layout :cols='2' :$title x-data="{
                editable: {{ $id ? 'false' : 'true' }},
            
            }">

                <x-slot name="action">
                    @if ($id)
                        <x-button x-on:click="editable=!editable">
                            <span x-text="editable ? 'Disable Edit' :'Allow Edit' "></span>
                        </x-button>
                        <x-button variant="danger" x-data
                            @click="$dispatch('confirm',{subtitle:`This action can't be undone`,eventToEmit:`deleteEmployee`})"
                            class="btn-error">Delete</x-button>
                    @endif

                    <x-button wire:click='save' variant="primary" spinner>Save</x-button>
                </x-slot>

                @if ($id)
                    <x-modal class="min-w-[22rem] space-y-6" wire:model='showDeleteModal' title="Delete Employee?"
                        subtitle="You're about to delete this employee.
                                This action cannot be reversed"
                        separator>

                        <x-slot:actions>
                            <x-button label="Cancel" @click="$wire.showDeleteModal = false" />
                            <x-button label="Confirm" wire:click='delete' class="btn-primary" />
                        </x-slot:actions>
                    </x-modal>
                @endif

                <div class="space-y-5">

                    <x-card title="Avatar">
                        <x-file wire:model="avatar" accept="image/png, image/jpeg">
                            <img src="{{ $user?->avatar ?? '/storage/uploads/empty-user.jpg' }}" class="h-40 rounded-lg" />
                        </x-file>
                    </x-card>


                    <x-card title="Basic Details" x-bind:disabled="!editable" class="space-y-5">
                        <div class="space-y-5">
                            <x-input wire:model='name' label="Name" x-bind:disabled="!editable" />
                            <x-input wire:model='email' label="Email" type="email" x-bind:disabled="!editable" />
                            <x-password right wire:model='password' label="Password" type="password"
                                x-bind:disabled="!editable" />
                        </div>
                    </x-card>

                </div>

                <div>
                    <x-card title="Other Information" x-bind:disabled="!editable" class="space-y-5">
                        <div class="space-y-5">
                            <x-input wire:model="phone_number" label="Phone Number" type="text"
                                x-bind:disabled="!editable" />

                            <x-input wire:model="whatsapp_number" label="WhatsApp Number" type="text"
                                x-bind:disabled="!editable" />


                            <x-input wire:model="date_of_joining" label="Date of Joining" type="date"
                                x-bind:disabled="!editable" />
                            <x-input wire:model="salary" label="Salary" type="number" x-bind:disabled="!editable" />

                            <x-textarea wire:model="note" label="Note" x-bind:disabled="!editable" />
                            <x-select placeholder="Select" :options="$designations" wire:model="job_designation"
                                label="Job Designation" x-bind:disabled="!editable" />
                            <x-radio wire:model="role" label="Role" :options="[
                                [
                                    'id' => 'employee',
                                    'name' => 'Employee',
                                ],
                                [
                                    'id' => 'admin',
                                    'name' => 'Admin',
                                ],
                                [
                                    'id' => 'suspended',
                                    'name' => 'Suspended',
                                ],
                            ]" x-bind:disabled="!editable" />
                        </div>
                    </x-card>

                </div>
            </x-layout>

        </div>
    @endvolt
</x-app-layout>
