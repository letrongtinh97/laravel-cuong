<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category_Product;
use App\Brand_Product;
use App\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $category = Category_Product::where('status' , '=' , 1)->orderBy('id' , 'DESC')->get();
        $brand    = Brand_Product::where('status' , '=' , 1)->orderBy('id' , 'DESC')->get();
        $orderNew = Order::where('status' , '=' , 0)->get();

        View::share(compact('category' , 'brand' , 'orderNew'));
    }
}
