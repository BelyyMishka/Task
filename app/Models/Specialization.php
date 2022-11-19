<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function add($request)
    {
        $specialization = new Specialization();
        $specialization->name = $request->name;
        $specialization->description = $request->description;

        if ($request->hasFile('image')) {
            $path = static::addImage($request->file('image'));
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

    public function edit($request)
    {
        $this->name = $request->name;
        $this->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $this->editImage($request->file('image'));
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
