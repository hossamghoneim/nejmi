<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateRelation extends Model
{
    protected $table = "affiliate_relations";

    protected $guarded = [];

    public function affiliate()
    {
        return $this->belongsTo('App\Affiliate');
    }
}
