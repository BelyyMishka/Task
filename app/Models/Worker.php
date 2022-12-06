<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Worker extends Model
{
    use HasFactory, Image, Date;

    private const IMAGE_FOLDER = 'workers';

    /*
     * One to many
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public static function add(array $data)
    {
        $worker = new Worker();
        $worker->name = $data['name'];
        $worker->description = $data['description'];
        $worker->specialization_id = $data['specialization_id'];

        if (Arr::has($data, 'image')) {
            $path = static::addImage($data['image']);
            $worker->image = $path;
        }

        $worker->save();

        return $worker;
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();

        return true;
    }

    public function edit(array $data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->specialization_id = $data['specialization_id'];

        if (Arr::has($data, 'image')) {
            $path = $this->editImage($data['image']);
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
