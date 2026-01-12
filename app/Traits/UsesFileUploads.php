<?php


namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UsesFileUploads
{


    public function upload(string $fieldname, UploadedFile $file, string $disk = null)
    {
        $the_disk = $disk ?? config('media.disk');

        $name = time() . $file->getClientOriginalName();


        if ($file->storeAs('uploads/', $name, $the_disk)) {
            $this->{$fieldname} = $name;
            return $name;
        }
    }

    public function remove(string $fieldname, string $disk = null)
    {


        $the_disk = $disk ?? config('media.disk');

        $filepath = 'uploads/' . $this->{$fieldname};

        if (Storage::disk($the_disk)->exists($filepath) && Storage::disk($the_disk)->delete($filepath)) {

            return $this->{$fieldname} = null;
        }
    }

    public function getUrl(string $fieldname)
    {
        $the_disk = $disk ?? config('media.disk');
        return $this->{$fieldname} ?  Storage::disk($the_disk)?->url('uploads/' . $this->{$fieldname}) : null;
    }

    public function is($type, $fieldname = 'filename')
    {
        $mime = Storage::disk(config('media.disk'))->mimeType('uploads/' . $this->{$fieldname});
        return strpos($mime, $type) !== false;
    }


    protected static function boot()
    {


        parent::boot();

        static::deleting(function ($model) {
            if (isset($this->media_fields))
                foreach ($this->media_fields as $field) {
                    $model->remove($field);
                }
        });


        if (method_exists(static::class, 'onBoot') && is_callable([static::class, 'onBoot'])) {
            try {
                static::onBoot();
            } catch (Exception $e) {
                // Handle the exception
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
