<?php

namespace App\repositories\contracts;

use App\Models\MessageModel;

interface MessageRepositoryContract{
    public function all();
    public function store(string $title, string $message , int|null  $parent_id);
}
