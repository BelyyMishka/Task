<?php

namespace App\Models;

use App\Traits\Date;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function add($request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->user_id = $request->user_id;

        if ($request->hasFile('image')) {
            $path = static::addImage($request->file('image'));
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

    public function edit($request)
    {
        $this->name = $request->name;
        $this->description = $request->description;
        $this->user_id = $request->user_id;

        if ($request->hasFile('image')) {
            $path = $this->editImage($request->file('image'));
            $this->image = $path;
        }

        $this->save();

        return $this;
    }
}
