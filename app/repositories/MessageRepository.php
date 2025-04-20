<?php

namespace App\repositories;

use App\Models\MessageModel;
use App\repositories\contracts\MessageRepositoryContract;

class MessageRepository implements MessageRepositoryContract{
    // public function all():array{
    //     $query= MessageModel::all();
    //     $result = [] ;
    //     foreach ($query as $message) {
    //         if ($message->parent_id) {
    //             $result[$message->parent_id]['replies'][] = $message;
    //         } else {
    //             $result[$message->id]['message'] = $message ;
    //             $result[$message->id]['replies'] = null ;
    //         }
    //     }
    //     return $result;
    // }
    public function all(){
        return MessageModel::withReplies()->get();
    }
}
