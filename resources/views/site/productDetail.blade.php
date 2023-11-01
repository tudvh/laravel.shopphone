@extends('layout.site')

@section('title', $product->name)

@section('meta')
<meta name="product-id" data-index="{{ $product->id }}">
@stop

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/list-product.css')}}">
<link rel="stylesheet" href="{{url('public/site/css/product-detail.css')}}">
@stop

@section('main')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="product-detail">
    <div class="row">
        <div class="col-12 col-md-5">
            <?php
            $listImage = json_decode($product->image);
            ?>
            <div class="slider">
                <div class="slider-content">
                    <div class="slider-wrapper">
                        <div class="slider-main">
                            @foreach($listImage as $image)
                            <div class="slider-item">
                                <img src="{{ $image }}" alt="{{ $product->slug }}" />
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <i class="fa fa-angle-left slider-prev"></i>
                    <i class="fa fa-angle-right slider-next"></i>
                </div>

                <div class="slide-dots-wrapper">
                    <ul class="slider-dots">
                        @foreach($listImage as $key => $image)
                        <li class="slider-dot-item">
                            <img src="{{ $image }}" alt="{{ $product->slug }}" data-index="{{ $key }}" />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-7">
            <p class="title">{{ $product->name }}</p>
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
            <div class="product-description">
                @if($product->description)
                {!! $product->description !!}
                @else
                <p>Chúng tôi đang cập nhật mô tả cho sản phẩm này...</p>
                @endif
            </div>
            <div class="product-quantity">
                <input type="number" id="product-quantity" min="1" max="{{ $product->quantity }}" value="1">
                <span>{{ $product->quantity }} sản phẩm có sẵn</span>
            </div>
            <div class="action d-flex gap-3">
                <a href="#" class="btn-add-to-cart">
                    <button class="buttons">Thêm vào giỏ hàng</button>
                </a>
                <a href="#specs">
                    <button class="buttons">Chi tiết</button>
                </a>
                <a href="#comment">
                    <button class="buttons">Bình luận</button>
                </a>
            </div>

        </div>
    </div>
</div>

<div id="specs" class="mt-5">
    <p class="title">THÔNG SỐ KỸ THUẬT</p>
    <table>
        {!! $product->specs !!}
    </table>
</div>

<div class="row list-product">
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

<div id="comment" class="my-5 mx-4">
    <p class="title">Bình luận</p>

    <div class="write-comment d-flex align-items-center mb-2">
        @csrf
        <input type="hidden" name="user-id" value="{{ $userID }}">

        <textarea class="write-comment-textarea" placeholder="Viết bình luận..." rows="2"></textarea>
        <button class="btn-send btn-send-row-2 ms-4">Bình luận</button>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <i class="fa-solid fa-spinner icon-spinner hidden"></i>
    </div>

    <div class="view-comment mt-2">
        @include('component.comment')
    </div>
</div>

@stop

@section('js')
<script src="{{url('public/site/js/product-detail.js')}}"></script>
<script src="{{url('public/site/js/comment.js')}}"></script>
@stop