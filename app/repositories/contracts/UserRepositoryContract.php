<?php

namespace App\repositories\contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryContract {
    public function index ():Collection;
    public function store(string $name , string $email , string $password , string $image ):User;
    public function show (int $id):User;
    public function showProfile (int $id):User;
    public function destroy(int $id):int;
}
