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

    public function getById($id)
    {
        return Specialization::find($id);
    }

    public function add($request)
    {
        return Specialization::add($request);
    }

    public function remove($specialization)
    {
        if ($specialization->workers->count() > 0) {
            return false;
        }

        $specialization->remove();
        return true;
    }

    public function edit($specialization, $request)
    {
        return $specialization->edit($request);
    }
}
