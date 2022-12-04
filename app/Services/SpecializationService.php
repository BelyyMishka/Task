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
        return Specialization::findOrFail($id);
    }

    public function add($request)
    {
        return Specialization::add($request);
    }

    public function remove($id)
    {
        $specialization = $this->getById($id);

        if ($specialization->workers->count() > 0) {
            return false;
        }

        $specialization->remove();
        return true;
    }

    public function edit($id, $request)
    {
        $specialization = $this->getById($id);

        return $specialization->edit($request);
    }
}
