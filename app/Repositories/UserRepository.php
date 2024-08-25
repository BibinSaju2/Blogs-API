<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
      return User::all();
    }

    public function create(array $data)
    {
        $user = User::create($data);
        return new UserResource($user);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}
