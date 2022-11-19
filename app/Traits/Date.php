<?php

namespace App\Traits;

trait Date
{
    public function getDate($format = 'F j, Y', $column = 'created_at')
    {
        return $this->$column->format($format);
    }
}
