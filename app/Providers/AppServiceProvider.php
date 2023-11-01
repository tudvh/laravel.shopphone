<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {

            // Side bar
            $listCategoryID = Product::select('category_id')->distinct()->get()->pluck('category_id')->toArray();
            $listCategory = Category::select('id', 'name', 'slug')->whereIn('id', $listCategoryID)->where('status', 1)->get()->toArray();

            foreach ($listCategory as $key => $item) {
                $listBrandID = Product::select('brand_id')->distinct()->where('category_id', $item)->get()->pluck('brand_id')->toArray();;
                $listBrand = Brand::select('id', 'name', 'slug')->whereIn('id', $listBrandID)->where('status', 1)->get()->toArray();

                $listCategory[$key]['listBrand'] = $listBrand;
            }

            $view->with([
                'listCategory' => $listCategory
            ]);
        });
    }
}
