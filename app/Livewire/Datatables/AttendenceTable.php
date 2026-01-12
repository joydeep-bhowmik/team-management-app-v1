<?php
namespace App\Livewire\Datatables;

use App\Models\Attendence;
use App\Models\User;
use JoydeepBhowmik\LivewireDatatable\Datatable;

class AttendenceTable extends Datatable
{
    public function builder()
    {
        return Attendence::query()->with('user');
    }

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
                    $link = route('attendences.edit', $row->id);
                    return <<<HTML
                <a x-navigate href="$link">
                <svg class='size-6' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z"></path></svg>
                </a>
                HTML;
                }),
            // id field
            $this->field('avatar')
                ->label('Avatar')
                ->value(function ($row) {

                    $user = User::find($row->user_id);
                    return $user->avatar ? '<img src="' . $user->avatar . '" alt="Avatar" width="50" />' : 'None';
                }),

            $this->field('Name')
                ->value(function ($row) {

                    $user = User::find($row->user_id);
                    return $user->name;
                })->searchable(function ($q, $keyword) {

                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });
            }),
            $this->field('Email')
                ->value(function ($row) {

                    $user = User::find($row->user_id);
                    return $user->email;
                }),
            $this->field('status')
                ->label('Status')
                ->value(function ($row) {
                    return ucfirst($row->status);
                }),

            $this->field('in_time')
                ->label('In time')
                ->value(function ($row) {

                    return $row->in_time?->format('h:i A');
                }),

            $this->field('out_time')
                ->label('Out time')
                ->value(function ($row) {

                    return $row->out_time?->format('h:i A');
                }),
            // created at
            $this->field('created_at')
                ->label('Created At')
                ->value(function ($row) {
                    return $row->created_at->format('d M, Y');
                })
                ->sortable(),

            // created at
            $this->field('updated_at')
                ->label('Updated At')
                ->value(function ($row) {
                    return $row->updated_at->format('d M, Y');
                })
                ->sortable(),
        ];
    }

    public function filters()
    {

        return [
            $this->filter('date')
                ->label('Date')
                ->type('date')
                ->query(function ($query, $value) {
                    $query->whereDate('created_at', $value);
                }),
        ];
    }
}
