<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $guarded=[];
    protected $appends = ['Tax','TotalPrice','Totaldetail'];
    public function getTaxAttribute()
    {
        //MENDAPATKAN TAX 2% DARI TOTAL HARGA
        return ($this->total * 2) / 100; 
    }

    public function getTotaldetailAttribute(){
        return count($this->detail);
    }
    
    public function getTotalPriceAttribute()
    {
        //MENDAPATKAN TOTAL HARGA BARU YANG TELAH DIJUMLAHKAN DENGAN TAX
        return ($this->total + (($this->total * 2) / 100));
    }

    public function customer(){
        return $this->belongsTo(customer::class);
    }

    public function detail(){
        return $this->hasMany(Invoice_detail::class);
    }
}
