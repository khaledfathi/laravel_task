<?php

namespace App\repositories\contracts;

use App\Models\User;

interface UserRepositoryContract {
    public function store(string $name , string $email , string $password , string $image ):User;
    public function show (int $id):User;
}
