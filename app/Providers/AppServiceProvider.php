<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; //Import Schema
use App\Invoice_detail;
use App\Observers\Invoice_detailObserver;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        //
    }

    
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Invoice_detail::observe(Invoice_detailObserver::class);
    }
}
