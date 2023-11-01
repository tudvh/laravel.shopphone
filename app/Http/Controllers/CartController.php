<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\CartHelper;
use App\Models\Product;

class CartController extends Controller
{
    public function view(CartHelper $cart)
    {
        $listCategoryID = $cart->getListCategoryID();
        $listProductID = $cart->getListProductID();

        $listProductSuggest = Product::whereIn('category_id', $listCategoryID)
            ->whereNotIn('id', $listProductID)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $listProductSuggest = $listProductSuggest->shuffle();

        return view('site.cart', compact('cart', 'listProductSuggest'));
    }

    public function add(CartHelper $cart, Product $product, Request $req)
    {
        $quantity = $req->query('quantity') ? $req->query('quantity') : 1;
        $quantity = (int)$quantity;

        if ($quantity <= 0) {

            return redirect()->back()->with('error', 'Có lỗi trong khi thêm sản phẩm vào giỏ hàng, vui lòng thử lại sau!');
        } else if ($quantity >= $product->quantity) {

            $cart->add($product, $product->quantity);

            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        } else {

            $cart->add($product, $quantity);

            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        }
    }

    public function update(CartHelper $cart, $id, $quantity = 1)
    {
        $product = Product::select('name', 'quantity')->where('id', $id)->first();

        if ($quantity <= 0) {

            return redirect()->back()->with('error', 'Có lỗi trong lúc cập nhật giỏ hàng. Vui lòng thử lại sau!');
        } else if ($quantity >= $product->quantity) {

            $cart->update($id, $product->quantity);

            return redirect()->back()->with('error', $product->name . ' hiện còn ' . $product->quantity . ' sản phẩm');
        } else {

            $cart->update($id, $quantity);

            return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
        }
    }

    public function remove(CartHelper $cart, $listID)
    {
        $listID = explode(',', $listID);

        foreach ($listID as $id) {
            if (is_numeric($id)) {
                $cart->remove($id);
            } else {
                return redirect()->back()->with('error', 'Có lỗi trong lúc xóa sản phẩm khỏi giỏ hàng, vui lòng thử lại sau!');
            }
        }

        return redirect()->back()->with('success', 'Sản phẩm được gỡ khỏi giỏ hàng thành công');
    }

    public function clear(CartHelper $cart)
    {
        $cart->clear();

        return redirect()->back()->with('success', 'Tât cả sản phẩm được gỡ khỏi giỏ hàng thành công');
    }
}
