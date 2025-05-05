<?php

namespace App\repositories\contracts;

use App\Models\MessageModel;

interface MessageRepositoryContract{
    public function all();
    public function store(string $title, string $message , string|null $file=null,  int|null $user_id=null ,  int|null  $parent_id=null):int;
}
