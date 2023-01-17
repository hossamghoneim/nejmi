<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedUser extends Model
{
    protected $table = "featured_users";

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
