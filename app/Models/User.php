<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    public static function add(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->description = $data['description'];

        if (Arr::has($data, 'image')) {
            $path = static::addImage($data['image']);
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

    public function edit($data)
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
