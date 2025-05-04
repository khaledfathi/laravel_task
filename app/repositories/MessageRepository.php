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
    public function store(string $title, string $message, int|null $parent_id=null)
    {
        MessageModel::create([
            'title' => $title,
            'body' => $message,
            'parent_id' => $parent_id
        ]);
    }
}
