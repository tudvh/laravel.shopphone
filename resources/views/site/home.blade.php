@extends('layout.site')

@section('title', 'Trang chủ')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/home.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/list-product.css') }}">
@stop

@section('main')
<div class="home-wrapper">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach ($banner as $value)

            @php
            $link = 'public/' . $value->image;
            $imageWrapperClass = ($loop->first) ? 'carousel-item active' : 'carousel-item';
            @endphp

            <div class="{{ $imageWrapperClass }}" data-bs-interval="2000">
                <img src="{{ $link }}" class="d-block w-100" alt="...">
            </div>

            @endforeach
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- List product sale -->
    @foreach($listSale as $sale)
    <div class="row list-product mt-4 bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <p class="title">{{ $sale->name }}</p>
            <a href="#" class="view-all pe-3">Xem tất cả</a>
        </div>

        @foreach($sale->products->random(3) as $product)
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
    @endforeach

    <!-- List product new -->

    <div class="row list-product mt-4 bg-white">
        <p class="title">Sản phẩm mới nhất</p>

        @foreach($listProductNew->random(6) as $product)
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
</div>
@stop