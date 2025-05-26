<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function scopeWithMessageCount(Builder $query, int $userId)
    {

        return $query
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.image',
                DB::raw('COUNT(messages.id) as message_count'),
                DB::raw('SUM(CASE WHEN messages.parent_id IS NOT NULL THEN 1 ELSE 0 END) as reply_message_count'),
            ])
            ->leftJoin('messages', 'messages.user_id', '=', 'users.id')
            ->where('users.id', $userId) // Filter by user ID
            ->groupBy('users.id', 'users.name', 'users.email', 'users.image'); // Group by user fields
    }
}
