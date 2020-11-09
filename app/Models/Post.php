<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    protected $table = 'posts';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime: d.m.Y H:i'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function urlShow () {
        return route('posts.show', $this->id);
    }

    public function contentShorten ($count, $end = '...') {
        return Str::limit($this->content, $count, $end);
    }

    public function comments () {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderByDesc('created_at');
    }

}
