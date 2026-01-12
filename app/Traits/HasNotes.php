<?php

namespace App\Traits;

use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNotes
{

    protected static function bootHasNotes()
    {
        return static::deleting(function ($model) {
            Note::where('model_type', class_basename($model))?->delete();
        });
    }


    function getNotes()
    {
        return $this->notes()->get();
    }

    function notes()
    {
        $notes = Note::where('model_type', class_basename($this))
            ->where('model_id', $this->{$this->primaryKey});
        return  $notes;
    }

    function addNote(string $title, string $description = '')
    {
        return $this->saveNote($title, $description);
    }

    function saveNote(string $title, $description, string|null $id = null)
    {

        $note = $id ? Note::find($id) : new Note();

        if ($note) {

            $note->title = $title;

            $note->description = $description;

            $note->model_id = $this->{$this->primaryKey};

            $note->model_type = class_basename($this);

            return  $note->save();
        }
    }
}
