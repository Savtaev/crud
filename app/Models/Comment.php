<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'email_verified_at',
    ];
    protected $hidden = [
        'email',
        'email_verified_at',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
