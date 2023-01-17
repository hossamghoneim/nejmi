<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateOrder extends Model
{
    protected $table = "affiliate_orders";

    protected $guarded = [];

    public function affiliate()
    {
        return $this->belongsTo('App\Affiliate');
    }
}
