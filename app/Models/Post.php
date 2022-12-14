<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable;
    public function author(){
        return $this->hasOne(User::class, 'id', 'author_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', 'id')->with('author');
    }
}
