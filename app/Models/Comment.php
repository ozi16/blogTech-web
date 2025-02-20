<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'name', 'email', 'comment', 'parent_id'];

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Balasan Komentar
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
