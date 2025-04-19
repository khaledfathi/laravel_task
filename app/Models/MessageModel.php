<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;
    public $table= 'messages';
    protected $fillable =[
        'title',
        'body',
        'file',
        'hidden',
        'parent_id'
    ];


}
