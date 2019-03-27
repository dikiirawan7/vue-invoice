<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_detail extends Model
{
    //
    protected $guarded=[];
    protected $appends = ['Subtotal'];
    public function getSubtotalAttribute()
    {
        //NILAI DARI SUBTOTAL ADALAH QTY * PRICE
        return $this->qty * $this->price;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
