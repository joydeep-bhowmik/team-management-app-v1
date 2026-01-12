<?php
namespace App\Livewire\Datatables;

use App\Models\Task;
use JoydeepBhowmik\LivewireDatatable\Datatable;

class EmployeeTaskTable extends Datatable
{

    public string $employee_id;

    public $perPage = 2;

    public function mount(string $employee_id)
    {

        $this->employee_id = $employee_id;
        $this->setup();
    }

    public function builder()
    {
        return Task::where(function ($query) {
            $query->where('assignee_id', $this->employee_id)
                ->orWhere('assigner_id', $this->employee_id);
        })
            ->with(['assignee', 'assigner'])->latest();
    }

    public function table()
    {
        // table method must return an array
        return [
            $this->field('')
                ->value(function ($row) {

                    $viewlink = route('tasks.view', $row->id);
                    $editlink = route('tasks.edit', $row->id);

                    $html = <<<HTML
            <a x-navigate href="$viewlink">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path></svg>
            </a>
            HTML;
                    if ($row->assigner_id == $this->employee_id) {
                        $html .= <<<HTML
                        <a x-navigate href="$editlink" >
                        <svg class='size-6' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z"></path></svg>
                        </a>
                        HTML;
                    }

                    return $html;
                }),

            $this->field('title')
                ->label('Title')
                ->searchable(),

            $this->field('assigner_id')
                ->label('Assigned By')
                ->value(function ($row) {
                    $link = $row->assigner ? route('employees.view', $row->assigner?->id) : '';
                    return <<<HTML
            <a x-navigate href="$link" class='underline text-blue-400'>{$row->assigner?->name}</a>
            HTML;
                })
                ->searchable(function ($query, $search) {
                    $query->orWhereHas('assigner', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
                }),

            $this->field('assignee_id')
                ->label('Assigned To')
                ->value(function ($row) {
                    $link = $row->assignee ? route('employees.view', $row->assignee?->id) : '';
                    return <<<HTML
            <a x-navigate href="$link" class='underline text-blue-400'>{$row->assignee?->name}</a>
            HTML;
                })
                ->searchable(function ($query, $search) {
                    $query->orWhereHas('assignee', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
                }),
            // address field
            $this->field('priority')
                ->label('Priority')
                ->searchable(),
            // joining_date field
            $this->field('status')
                ->label('Status')
                ->searchable(),
            // job_designation field
            $this->field('due_date')
                ->label('Due Date')
                ->value(function ($row) {

                    return $row->due_date?->format('d M, Y');
                })
                ->sortable(),
            // created at
            $this->field('created_at')
                ->label('Created At')
                ->value(function ($row) {
                    return $row->created_at?->format('d M, Y h:i A');
                })
                ->sortable(),

            $this->field('updated_at')
                ->label('Updated At')
                ->value(function ($row) {
                    return $row->updated_at?->format('d M, Y h:i A');
                })
                ->sortable(),
        ];
    }

    public function filters()
    {
        return [

            //input type select
            $this->filter('status')
                ->label('Status')
            //this options are required for input type select
                ->options([
                    ''          => 'All',
                    'pending'   => 'Pending',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->type('select')
                ->value('pending')
                ->query(function ($query, $value) {
                    $query->where('tasks.status', $value);
                }),
        ];
    }
}
