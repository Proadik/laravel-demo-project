<?php

namespace App;

use App\Models\BlackList;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts () {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function isOwner ($obj) {

        if(auth()->user()->type == 'admin')
            return true;

        if($obj instanceof Post && $obj->user_id === $this->id) {
            return true;
        }
    }

    public function isBanned () {
        return BlackList::where('user_id', $this->id)->exists();
    }

    public function isBannedReason () {
        return BlackList::where('user_id', $this->id)->first()->reason;
    }

    public function getStatus () {
        if($this->isBanned())
            return ['status' => 'danger', 'content' => 'В бане'];

        return ['status' => 'success', 'content' => 'Активен'];
    }

}
