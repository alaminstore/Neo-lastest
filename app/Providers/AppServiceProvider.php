<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\ProductInfo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $currency_symbol      = '৳';
        View::share(['currency_symbol'=> $currency_symbol]);

        $setting = '';
        if(empty($setting))
        {
            $setting = '';
        }

        View::share('setting_for_all', $setting);

        $categories      = ProductCategory::with('subcategories', 'subcategories.productItems')->get()->take(10);
        $more_categories = ProductCategory::with('subcategories', 'subcategories.productItems')->get()->skip(10);
        $discount_product_exist = ProductInfo::where('percent', '>=',  1)->first();

        View::share([
            'menu_categories'=> $categories,
            'menu_more_categories'=> $more_categories,
            'discount_product_exist' => $discount_product_exist
        ]);
        
        Schema::defaultStringLength(191);

    }
}
