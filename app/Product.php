<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];

    //untuk find by nama di url nya
    public function getRouteKeyName(){
        return 'title';
    }
}
