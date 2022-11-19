<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Image
{
    protected static function addImage($image)
    {
        $date = date('d.m.Y');

        if (defined('static::IMAGE_FOLDER')) {
            $dir = static::IMAGE_FOLDER . "/{$date}";
        }
        else {
            $dir = "uploads/{$date}";
        }

        return Storage::putFile($dir, $image);
    }

    protected function removeImage()
    {
        if (empty($this->image) || !is_string($this->image)) {
            return;
        }

        if (Storage::exists($this->image)) {
            Storage::delete($this->image);
        }
    }

    protected function editImage($image)
    {
        $this->removeImage();

        return static::addImage($image);
    }
}
