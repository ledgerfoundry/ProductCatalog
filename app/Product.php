<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name','description'];
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category__products');
    }
}
