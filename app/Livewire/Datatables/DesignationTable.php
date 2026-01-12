<?php

namespace App\Livewire\Datatables;

use App\Models\UserDesignation;
use JoydeepBhowmik\LivewireDatatable\Datatable;

class DesignationTable extends Datatable
{
    public $model = UserDesignation::class;

    public function mount()
    {
        $this->setup();
    }

    public function table()
    {
        // table method must return an array
        return [
            $this->field('name')
                ->label('Name'),
            $this->field('edit')
                ->label('Edit')
                ->value(function ($row) {
                    $link = route('designations.edit', $row->id);
                    return <<<HTML
                    <a href="{$link}" x-navigate>Edit</a>
                    HTML;
                }),
        ];
    }
}
