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

    public function update(int $id , string|null $name=null , string|null $email=null , string|null $password=null , string|null $image=null ):int{
        $data = [];
        $name ? $data['name'] = $name : 0;
        $email? $data['email'] = $email : 0;
        $password? $data['password'] = $password: 0;
        $image ? $data['image'] = $image: 0;
        $userFound = User::find($id);
        if($userFound){
            return $userFound->update($data);
        }
        return 0;
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
