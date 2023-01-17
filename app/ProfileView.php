<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    protected $guarded = [];

    public function freelancer()
    {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
