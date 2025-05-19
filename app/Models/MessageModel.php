<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;
    public $table = 'messages';
    protected $fillable = [
        'title',
        'body',
        'file',
        'user_id',
        'parent_id'
    ];

    // releationships ->>>>
    public function replies()
    {
        return $this->hasMany(MessageModel::class, 'parent_id');
    }
    public function replyParent()
    {
        return $this->belongsTo(MessageModel::class, 'parent_id');
    }
    // END - releationships ->>>>

    // Query Scops ->>>>
    public function scopeWithParentOnly(Builder $query)
    {
        return $query
            ->select(['users.name as user_name', 'users.image as user_image', 'messages.*'])
            ->leftJoin('users', 'messages.user_id', '=', 'users.id')
            ->where('messages.parent_id', '=', null)
            ->where(function ($query) {
                $query->whereColumn('messages.user_id', '=', 'users.id')
                    ->orWhereNull('messages.user_id');
            });
    }

    public function scopeWithCountReplies(Builder $query)
    {
        return $query->withCount('replies');
    }

    public function scopeWithReplies(Builder $query)
    {
        return $query->withParentOnly()->withCountReplies()->with(['replies' => function ($q) {

            $q->select(['users.name as user_name', 'users.image as user_image', 'messages.*'])
                ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                ->where(function ($query) {
                    $query->whereColumn('messages.user_id', '=', 'users.id')
                        ->orWhereNull('messages.user_id');
                });
        }]);
    }
    public function scopeWithReplyUserData(Builder $query)
    {
        $query
            ->select(['users.name as user_name', 'users.image as user_image', 'messages.*'])
            ->join('users', 'messages.user_id', '=', 'users.id');
    }
    // END - Query Scops ->>>>
}
