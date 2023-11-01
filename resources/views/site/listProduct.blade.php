@extends('layout.site')

@section('title', 'Danh sách sản phẩm')

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/list-product.css')}}">
@stop

@section('main')
<p class="title">{{ $title }}</p>

<div class="row list-product">
    @foreach($listProduct as $product)
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

<div class="px-4">
    {{ $listProduct->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

@stop