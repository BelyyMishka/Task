<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function paginate(int $count)
    {
        return User::paginate($count);
    }

    public static function all()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function add($request)
    {
        return User::add($request);
    }

    public function remove($id)
    {
        $user = $this->getById($id);

        if ($user->books->count() > 0) {
            return false;
        }

        $user->remove();
        return true;
    }

    public function edit($id, $request)
    {
        $user = $this->getById($id);

        return $user->edit($request);
    }
}
