<?php

namespace App\repositories;

use App\Models\User;
use App\repositories\contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract{
    public function store(string $name , string $email , string $password , string $image):User{
        return User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'image'=>$image
        ]);
    }
}
