<?php

namespace App\Helper;

use App\Models\Product;

class CartHelper
{
    private $items = [];

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
    }

    public function getTotalPrice()
    {
        $t = 0;

        foreach ($this->items as $item) {
            $t += $item['salePrice'] * $item['quantity'];
        }

        return $t;
    }

    public function getTotalQuantity()
    {
        $t = 0;

        foreach ($this->items as $item) {
            $t += $item['quantity'];
        }

        return $t;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getListProductID()
    {
        $arr = [];

        foreach ($this->items as $item) {
            array_push($arr, $item['id']);
        }

        return $arr;
    }

    public function getListCategoryID()
    {
        $arr = [];

        foreach ($this->items as $item) {
            array_push($arr, $item['category_id']);
        }

        return $arr;
    }

    public function add(Product $product, $quantity = 1)
    {
        $salePrice = $product->price;

        switch ($product->sale->discount_unit) {
            case '%':
                $salePrice = $product->price - ($product->price * $product->sale->discount / 100);
                break;

            case 'vnd':
                $salePrice = $product->price - $product->sale->discount;
                break;
        }

        $imageFirst = json_decode($product->image)[0];

        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $quantity,
            'price' => $product->price,
            'salePrice' => $salePrice,
            'image' => $imageFirst,
            'category_id' => $product->category_id,
            'brand_id' => $product->brand_id
        ];

        if (isset($this->items[$product->id])) {

            $productQuantity = $product->quantity;
            $cartQuantity = $quantity + $this->items[$product->id]['quantity'];

            $this->update($product->id, $cartQuantity, $productQuantity);

            return;
        }

        $this->items[$product->id] = $item;

        $this->commit();
    }

    public function update($id, $cartQuantity = 1, $productQuantity = null)
    {
        if (isset($this->items[$id])) {

            if ($productQuantity && $cartQuantity >= $productQuantity) {

                $this->items[$id]['quantity'] = $productQuantity;
            } else {

                $this->items[$id]['quantity'] = $cartQuantity;
            }

            $this->commit();
        }
    }

    public function remove($id)
    {
        if (isset($this->items[$id])) {

            unset($this->items[$id]);

            $this->commit();
        }
    }

    public function clear()
    {
        $this->items = [];

        $this->commit();
    }

    private function commit()
    {
        session(['cart' => $this->items]);
    }
}
