<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateTransaction extends Model
{
    protected $table = "affiliate_transactions";

    protected $guarded = [];

    public function affiliate()
    {
        return $this->belongsTo('App\Affiliate');
    }
}
