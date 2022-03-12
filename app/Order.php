<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $appends =  ['time'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function freelancer() {
        return $this->belongsTo('App\User', 'target_id', 'id');
    }

    public function getTimeAttribute() {
        return $this->created_at->format("Y-m-d");
    }

}
