<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photopost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
