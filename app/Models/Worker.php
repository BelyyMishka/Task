<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function add($request)
    {
        $worker = new Worker();
        $worker->name = $request->name;
        $worker->description = $request->description;
        $worker->specialization_id = $request->specialization_id;

        if ($request->hasFile('image')) {
            $path = static::addImage($request->file('image'));
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

    public function edit($request)
    {
        $this->name = $request->name;
        $this->description = $request->description;
        $this->specialization_id = $request->specialization_id;

        if ($request->hasFile('image')) {
            $path = $this->editImage($request->file('image'));
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
