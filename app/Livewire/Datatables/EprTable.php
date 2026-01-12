<?php

namespace App\Livewire\Datatables;

use App\Models\Epr;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use JoydeepBhowmik\LivewireDatatable\Datatable;
use Livewire\Attributes\On;
use Mary\Traits\Toast;

class EprTable extends Datatable
{
    use Toast;

    protected $listeners = ['refresh-eprs' => '$refresh'];
    public string $user_id;

    public function mount(string $user_id)
    {
        $this->user_id = $user_id;

        $this->setup();
    }

    public function builder()
    {
        return Epr::where('user_id', $this->user_id)->orderBy('month');
    }

    public function dispatchDeleteEpr(string $id)
    {
        $this->dispatch('confirm', eventToEmit: 'deleteEpr', data: [$id]);
    }

    #[On('deleteEpr')]
    public function delete(string $id)
    {

        $epr = Epr::find($id);

        if ($epr?->delete()) {

            $this->success('Deleted');
        }
    }

    public function dispatchEditEpr(string $id)
    {

        $this->dispatch('editEpr', $id);
    }

    public function table()
    {
        // table method must return an array
        return [

            auth()->user()->isAdmin() ? $this->field('')
                ->value(function ($row) {
                    return Blade::render('<x-button icon="o-trash" class="btn-error"  spinner wire:click="dispatchDeleteEpr(' . $row->id . ')"/><x-button icon="o-pencil" spinner wire:click="dispatchEditEpr(' . $row->id . ')" />');
                }) : $this->field(''),
            $this->field('month')
                ->label('Month')
                ->value(function ($row) {

                    return $row->month->format(' M Y');
                }),
            $this->field('value')
                ->label('Value'),

            $this->field('note')
                ->label('Note'),

        ];
    }
}
