@extends('layout.site')

@section('title', 'Giỏ hàng')

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/list-product.css')}}">
<link rel="stylesheet" href="{{ url('public/site/css/cart.css') }}">
@stop

@section('main')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(!$cart->getTotalQuantity())
<div class="p-5">
    <h2>Giỏ hàng trống!</h2>
</div>
@else
<div class="cart">
    <table>
        <thead>
            <tr>
                <th>
                    <input type="checkbox">
                </th>
                <th class="text-center">Sản phẩm</th>
                <th class="text-center">Đơn giá</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Thành tiền</th>
                <th class="text-end"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->getItems() as $cartItem)
            <tr class="cart-item" data-index="{{ $cartItem['id'] }}">
                <td>
                    <input type="checkbox" data-index="{{ $cartItem['id'] }}">
                </td>

                <td class="text-start">
                    <a href="{{ route('home.product.detail', ['product'=>$cartItem['id'], 'productSlug'=>Str::slug($cartItem['name'])]) }}" class="name" title="{{ $cartItem['name'] }}">
                        <img src="{{ $cartItem['image'] }}" alt="{{ $cartItem['name'] }}">
                        <p>{{ Str::limit($cartItem['name'], 30) }}</p>
                    </a>
                </td>

                <td class="text-center">
                    @if($cartItem['price'] != $cartItem['salePrice'])
                    <p class="sale-price">{{number_format($cartItem['salePrice'], "0", "0", ".")}} đ</p>
                    <p class="price">{{number_format($cartItem['price'], "0", "0", ".")}} đ</p>
                    @else
                    <p class="sale-price">{{number_format($cartItem['salePrice'], "0", "0", ".")}} đ</p>
                    @endif
                </td>

                <td class="text-center quantity">
                    <input type="number" min="1" value="{{ $cartItem['quantity'] }}">
                </td>

                <td class="text-center total">
                    {{number_format(($cartItem['salePrice']*$cartItem['quantity']), "0", "0", ".")}} đ
                </td>

                <td class="text-end action">
                    <a href="#" class="edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="{{ route('cart.remove', ['id'=>$cartItem['id']]) }}">
                        <i class="fa-solid fa-trash remove"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="cart-controll">
    <div class="remove">
        <a class="remove-many" href="#">Xóa sản phẩm đã chọn (<span class="total-check">0</span>)</a>
        <a onclick="confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng không?')" href="{{ route('cart.clear') }}" class="remove-all">Xóa tất cả</a>
    </div>
    <div class="checkout">
        <p class="total-price">
            Tổng cộng: <strong>{{ number_format(($cart->getTotalPrice()), "0", "0", ".") }} đ</strong>
        </p>
        <a href="{{ route('home.checkout') }}" class="btn-checkout">Mua hàng</a>
    </div>
</div>

<div class="row list-product mt-4">
    <p class="title">Sản phẩm tương tự</p>
    @foreach($listProductSuggest as $product)
    <div class="col-sm-12 col-md-4 product">
        <a href="{{ route('home.product.detail', ['productSlug'=>Str::slug($product->name), 'product'=>$product->id]) }}">
            <div class="product-discound">
                <span> @if($product->sale->id!=1) {{ $product->sale->name }} @endif </span>
            </div>
            <div class="product-img">
                <?php $imageFirst = json_decode($product->image)[0] ?>
                <img src="{{ $imageFirst }}" alt="{{ $product->name }}">
            </div>
            <p class="product-name">{{ $product->name }}</p>
            <div class="product-price">
                <?php
                $price = $product->price;
                if ($product->sale->id != 1) {
                    switch ($product->sale->discount_unit) {
                        case '%':
                            $salePrice = $price - ($price * $product->sale->discount / 100);
                            break;

                        case 'vnd':
                            $salePrice = $price - $product->sale->discount;
                            break;
                    }
                } else {
                    $salePrice = $price;
                }
                ?>
                <span class="sale-price">{{ number_format($salePrice, "0", "0", ".") }}đ</span>
                <span class="original-price">@if($salePrice != $price) {{ number_format($price, "0", "0", ".") }}đ @endif</span>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

@stop

@section('js')
<script src="{{url('public/site/js/cart.js')}}"></script>
@stop