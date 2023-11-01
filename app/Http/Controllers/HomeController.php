<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Sale;
use App\Models\Comment;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $searchKey = $request->search;

        if ($searchKey) {

            $title = 'Tìm kiếm sản phẩm';

            $listProduct = Product::where(function ($query) use ($searchKey) {
                $query->where('name', 'LIKE', "%{$searchKey}%")->orWhere('description', 'LIKE', "%{$searchKey}%")->orderBy('created_at', 'desc');
            })->paginate(9);

            return view('site.listProduct', compact('listProduct', 'title', 'searchKey'));
        } else {

            $banner = Banner::orderBy('priority')->get();
            $listSale = Sale::where('id', '!=', 1)->get();
            $listProductNew = Product::orderBy('created_at', 'desc')->get();

            return view('site.home', compact('banner', 'listSale', 'listProductNew'));
        }
    }

    public function categoryBrand($categorySlug, $brandSlug)
    {
        $categoryChecked = Category::where('slug', $categorySlug)->first();
        $brandChecked = Brand::where('slug', $brandSlug)->first();

        $title = $brandChecked->name . ' ' . $categoryChecked->name;

        $listProduct = Product::where('category_id', $categoryChecked->id)
            ->where('brand_id', $brandChecked->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('site.listProduct', compact('listProduct', 'categoryChecked', 'brandChecked', 'title'));
    }

    public function productDetail(Product $product)
    {
        $categoryChecked = Category::where('id', $product->category_id)->first();
        $brandChecked = Brand::where('id', $product->brand_id)->first();

        $listProductSuggest = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $listProductSuggest = $listProductSuggest->shuffle();
        $listComment = Comment::where('product_id', $product->id)->whereNull('reply_id')->orderBy('created_at', 'desc')->get();

        $userID = Auth::guard('cus')->check() ? Auth::guard('cus')->user()->id : null;

        return view('site.productDetail', compact('product', 'listProductSuggest', 'categoryChecked', 'brandChecked', 'listComment', 'userID'));
    }
}
