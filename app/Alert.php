<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $guarded = [];
    protected $appends =  ['time', 'rest'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getTimeAttribute() {
        return $this->created_at->format("Y-m-d");
    }
    public function getRestAttribute()
    {

        $start_time = Carbon::parse(now()->format("Y-m-d"));
        $finish_time = Carbon::parse($this->date);
        $interval = $start_time->diffInDays($finish_time, false);
        return $interval;
    }
}
