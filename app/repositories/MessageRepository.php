<?php

namespace App\repositories;

use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;

class MessageRepository implements MessageRepositoryContract{
    public function all(){
        return MessageModel::withReplies()->get();
    }
}
