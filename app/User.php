<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    protected $appends =  ['activated'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function videos() {
        return $this->hasMany('App\Video');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function views() {
        return $this->hasMany('App\ProfileView');
    }

    public function activations()
    {
        return $this->hasMany('App\Activation');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction')->latest();
    }

//    public function getActivatedAttribute() {
//        foreach ($this->activations as $activation) {
//            if($activation->status == 1)
//                return 1;
//        }
//        return 0;
//    }

}
