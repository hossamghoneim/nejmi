<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }
}
