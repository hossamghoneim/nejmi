<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $guarded = [];

    public function freelancers()
    {
        return $this->hasMany('App\AffiliateRelation');
    }

    public function orders()
    {
        return $this->hasMany('App\AffiliateOrder');
    }

    public function transactions()
    {
        return $this->hasMany('App\AffiliateTransaction');
    }

}
