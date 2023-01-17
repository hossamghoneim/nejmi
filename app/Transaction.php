<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $appends =  ['time'];

    public function getTimeAttribute() {
        return $this->created_at->format("Y-m-d");
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
