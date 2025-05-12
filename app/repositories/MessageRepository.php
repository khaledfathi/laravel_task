<?php

namespace App\repositories;

use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessageRepository implements MessageRepositoryContract
{
    public function all():LengthAwarePaginator
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
    public function show (int $id):MessageModel{
        return MessageModel::withReplies()->findOrFail($id);
    }
    public function destroy(int $id):int{
        return MessageModel::destroy($id);
    }

    public function destroyWithUser(int $id , int $userId):int{
        return MessageModel::where('id', $id)->where('user_id', $userId)->delete();
    }
}
