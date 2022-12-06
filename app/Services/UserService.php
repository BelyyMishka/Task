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

    public function add(array $data)
    {
        return User::add($data);
    }

    public function remove($user)
    {
        if ($user->books->count() > 0) {
            return false;
        }

        $user->remove();
        return true;
    }

    public function edit($user, array $data)
    {
        return $user->edit($data);
    }
}
