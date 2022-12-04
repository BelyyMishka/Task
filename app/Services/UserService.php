<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function paginate(int $count)
    {
        return User::paginate($count);
    }

    public function all()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function add($request)
    {
        return User::add($request);
    }

    public function remove($user)
    {
        if ($user->books->count() > 0) {
            return false;
        }

        $user->remove();
        return true;
    }

    public function edit($user, $request)
    {
        return $user->edit($request);
    }
}
