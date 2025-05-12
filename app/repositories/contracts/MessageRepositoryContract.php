<?php

namespace App\repositories\contracts;

use App\Models\MessageModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MessageRepositoryContract{
    public function all():LengthAwarePaginator;
    public function store(string $title, string $message , string|null $file=null,  int|null $user_id=null ,  int|null  $parent_id=null):int;
    public function show (int $id):MessageModel ;
    public function destroy(int $id):int;
    public function destroyWithUser(int $id , int $userId):int;
}
