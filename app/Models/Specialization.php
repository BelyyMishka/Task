<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Specialization extends Model
{
    use HasFactory, Image, Date;

    private const IMAGE_FOLDER = 'specializations';

    /*
     * One to many
     */
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public static function add(array $data)
    {
        $specialization = new Specialization();
        $specialization->name = $data['name'];
        $specialization->description = $data['description'];

        if (Arr::has($data, 'image')) {
            $path = static::addImage($data['image']);
            $specialization->image = $path;
        }

        $specialization->save();

        return $specialization;
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

        if (Arr::has($data, 'image')) {
            $path = $this->editImage($data['image']);
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
