<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    protected $fillable = ['image','header','link','description','btn_text'];
}
