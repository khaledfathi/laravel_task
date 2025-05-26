<?php

namespace App\repositories\contracts;

use App\enum\Order;
use App\Models\MessageModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MessageRepositoryContract{
    public function all(Order $order):LengthAwarePaginator;
    public function store(string $title, string $message , string|null $file=null,  int|null $user_id=null ,  int|null  $parent_id=null):int;
    public function update(int $id , string $title, string $message , string|null $file=null , bool $nullableFile=false ):int;
    public function show (int $id):MessageModel ;
    public function showWithReply (int $id):MessageModel ;
    public function destroy(int $id):array;
    public function destroyWithUser(int $id , int $userId):array;
}
