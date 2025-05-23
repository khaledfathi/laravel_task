<?php

namespace App\repositories;

use App\Models\User;
use App\repositories\contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryContract
{
    public function index(): Collection
    {
        return User::all();
    }
    public function store(string $name, string $email, string $password, string $image): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'image' => $image
        ]);
    }

    public function show(int $id): User
    {
        return User::findOrFail($id);
    }
    public function showProfile(int $id): User
    {
        return User::withMessageCount($id)->first();
    }
    public function destroy(int $id):int
    {
        return User::where('id', $id)->delete();
    }
}
