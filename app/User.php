<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
   public function photoposts()
    {
      return $this->hasMany(Photopost::class);
    }
   
   public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        $exist = $this->is_following($userId);
      
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_photoposts()
    {
        $follow_user_ids = $this->followings()-> pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Photopost::whereIn('user_id', $follow_user_ids);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Photopost::class, 'user_post', 'user_id', 'favorite_id')->withTimestamps();
    }
    
    public function favorite($photopostId)
    {
        $exist = $this->isFavorite($photopostId);
        $photopostUserId = Photopost::find($photopostId)->user_id;
        $its_me = $this->id == $photopostUserId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->favorites()->attach($photopostId);
            return true;
        }
    }

    public function unfavorite($photopostId)
    {
        $exist = $this->isFavorite($photopostId);
        $photopostUserId = Photopost::find($photopostId)->user_id;
        $its_me = $this->id == $photopostUserId;

         if ($exist && !$its_me) {
            $this->favorites()->detach($photopostId);
            return true;
        } else {
            return false;
        }
    }
    
    public function isFavorite($photopostId)
    {
        return $this->favorites()->where('favorite_id', $photopostId)->exists();
    }
    

    
}
