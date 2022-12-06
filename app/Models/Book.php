<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Book extends Model
{
    use HasFactory, Image, Date;

    private const IMAGE_FOLDER = 'books';

    /*
     * One to many
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add(array $data)
    {
        $book = new Book();
        $book->name = $data['name'];
        $book->description = $data['description'];
        $book->user_id = $data['user_id'];

        if (Arr::has($data, 'image')) {
            $path = static::addImage($data['image']);
            $book->image = $path;
        }

        $book->save();

        return $book;
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
        $this->user_id = $data['user_id'];

        if (Arr::has($data, 'image')) {
            $path = $this->editImage($data['image']);
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
