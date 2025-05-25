<?php

namespace App\repositories;

use App\constants\Constant;
use App\enum\Order;
use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MessageRepository implements MessageRepositoryContract
{
    public function all(Order $order): LengthAwarePaginator
    {
        return MessageModel::withReplies()->orderBy('created_at', $order->value)->paginate(10);
    }
    public function store(string $title, string $message, string|null $file = null,  int|null $user_id = null,  int|null  $parent_id = null): int
    {
        return MessageModel::create([
            'title' => $title,
            'body' => $message,
            'file' => $file,
            'user_id' => $user_id,
            'parent_id' => $parent_id
        ])->id;
    }

    public function update(int $id , string $title, string $message , string|null $file=null):int{
        $record= MessageModel::find($id);
        $data =[
            'title' => $title,
            'body' => $message,
        ];
        //
        if($file) $data['file'] = $file;
        //
        if($record){
            return $record->update($data);
        }
        return 0;
    }
    public function show(int $id): MessageModel {
        return MessageModel::findOrFail($id);
    }

    public function showWithReply(int $id): MessageModel
    {
        return MessageModel::withReplies()->findOrFail($id);
    }
    public function destroy(int $id): array
    {
        //find it
        $message = MessageModel::find($id);
        //
        $result = ['fileName' => null, 'deleted' => 0];
        if ($message) {
            $result['fileName'] = $message->file;
            $result['deleted'] = $message->delete();
        }
        return $result;
    }

    public function destroyWithUser(int $id, int $userId): array
    {
        //find it
        $message = MessageModel::where('id', $id)->where('user_id', $userId);
        //
        $result = ['fileName' => null, 'deleted' => 0];
        if ($message->first()) {
            $result['fileName'] = $message->first()->file;
            $result['deleted'] = $message->delete();
        }
        return $result;
    }
}
