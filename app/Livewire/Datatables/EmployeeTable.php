<?php

namespace App\Livewire\Datatables;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use JoydeepBhowmik\LivewireDatatable\Datatable;

class EmployeeTable extends Datatable
{
    public $model = User::class;

    public function mount()
    {
        $this->setup();
    }

    public function table()
    {
        // table method must return an array
        return [
            $this->field('')
                ->value(function ($row) {

                    $link = route('employees.view', $row->id);
                    return <<<HTML
            <a x-navigate href="$link">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path></svg>
            </a>
            HTML;
                }),
            $this->field('Edit')
                ->value(function ($row) {
                    $link = route('employees.edit', $row->id);
                    return <<<HTML
                <a x-navigate href="$link">
                <svg class='size-6' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z"></path></svg>
                </a>
                HTML;
                }),
            $this->field('uniqid')->label('Id'),
            // id field
            $this->field('avatar')
                ->label('Avatar')
                ->value(function ($row) {

                    return Blade::render('<x-avatar :image="$user?->avatar ?? \'/empty-user.jpg\'"  />');

                    return $row->avatar ? '<img src="' . $row->getUrl('avatar') . '" alt="Avatar" width="50" />' : 'None';
                }),
            // email field
            $this->field('email')
                ->label('Email')
                ->searchable(),
            $this->field('name')
                ->label('Name')
                ->searchable(),
            // role field
            $this->field('role')
                ->label('Role')
                ->sortable(),

            // joining_date field
            $this->field('date_of_joining')
                ->label('Joining Date')
                ->value(function ($row) {

                    return $row->date_of_joining?->format('d M, Y');
                })
                ->sortable(),
            // job_designation field
            $this->field('user_designation_id')
                ->label('Designation')
                ->value(function ($row) {
                    return $row->designation ? $row->designation->name : null;
                }),

            // salary field
            $this->field('salary')
                ->label('Salary')
                ->sortable(),
            // note field
            $this->field('note')
                ->label('note')
                ->searchable(),
            // created at
            $this->field('created_at')
                ->label('Created At')
                ->value(function ($row) {
                    return $row->created_at->format('d M, Y');
                })
                ->sortable(),
        ];
    }
}
