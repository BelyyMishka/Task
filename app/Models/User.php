<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Image, Date;

    private const IMAGE_FOLDER = 'users';

    /*
     * One to many
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function add($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->description = $request->description;

        if ($request->hasFile('image')) {
            $path = static::addImage($request->file('image'));
            $user->image = $path;
        }

        $user->save();

        return $user;
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
