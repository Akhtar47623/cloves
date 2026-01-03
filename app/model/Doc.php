<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Doc extends Model
{
    // use SoftDeletes;
    protected $table = 'documents';
    protected $guarded = [];
}
