<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
// use BinaryCats\Sku\HasSku;
use Cviebrock\EloquentSluggable\Sluggable;


class Service extends Model
{
	use Sluggable;
	// use HasSku;
    protected $table = 'services';
    protected $guarded = [];
      public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
