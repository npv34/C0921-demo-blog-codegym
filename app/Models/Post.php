<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    protected $hidden = ["created_at"];
    use HasFactory;

    function types() {
        return $this->belongsToMany(Type::class,'type_post');
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
