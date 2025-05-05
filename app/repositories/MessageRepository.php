<?php

namespace App\repositories;

use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;

class MessageRepository implements MessageRepositoryContract
{
    public function all()
    {
        return MessageModel::withReplies()->paginate(10);
    }
    public function store(string $title, string $message , string|null $file=null,  int|null $user_id=null ,  int|null  $parent_id=null):int
    {
        return MessageModel::create([
            'title' => $title,
            'body' => $message,
            'file'=>$file,
            'user_id'=>$user_id,
            'parent_id' => $parent_id
        ])->id;
    }
}
