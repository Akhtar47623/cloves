<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    // use SoftDeletes;
    protected $table = 'prices';
    protected $guarded = [];
}
