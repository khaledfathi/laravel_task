<?php

namespace App\repositories;

use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageRepositoryContract{
    public function all():Collection{
        // return MessageModel::all();
        return MessageModel::where('parent_id' , '=' , null)->get();
    }
}
