<?php

namespace App\Services;

use App\Models\Specialization;

class SpecializationService
{
    public function paginate(int $count)
    {
        return Specialization::paginate($count);
    }

    public function all()
    {
        return Specialization::all();
    }

    public function add(array $data)
    {
        return Specialization::add($data);
    }

    public function remove($specialization)
    {
        if ($specialization->workers->count() > 0) {
            return false;
        }

        $specialization->remove();
        return true;
    }

    public function edit($specialization, array $data)
    {
        return $specialization->edit($data);
    }
}
