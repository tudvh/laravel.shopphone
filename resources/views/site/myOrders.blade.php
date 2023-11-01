@extends('layout.site')

@section('title', 'Đơn mua')

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/my-orders.css')}}">
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

<div class="order-nav d-flex justify-content-between bg-white">
    <label class="@if($type=='all') checked @endif">
        <a href="{{ route('home.order.view', ['type'=>'all']) }}">TẤT CẢ</a>
    </label>
    <label class="@if($type==1) checked @endif">
        <a href="{{ route('home.order.view', ['type'=>1]) }}">CHỜ XÁC NHẬN</a>
    </label>
    <label class="@if($type==2) checked @endif">
        <a href="{{ route('home.order.view', ['type'=>2]) }}">ĐANG GIAO</a>
    </label>
    <label class="@if($type==3) checked @endif">
        <a href="{{ route('home.order.view', ['type'=>3]) }}">HOÀN THÀNH</a>
    </label>
    <label class="@if($type==4) checked @endif">
        <a href="{{ route('home.order.view', ['type'=>4]) }}">ĐÃ HỦY</a>
    </label>
</div>

@foreach($listOrder as $order)
<div class="order-content bg-white mt-4">
    <div class="order">
        <p class="text-end order-status">
            @switch($order->status)
            @case(1)
            Chờ xác nhận
            @break
            @case(2)
            Đang giao
            @break
            @case(3)
            Hoàn thành
            @break
            @case(4)
            Đã hủy
            @break
            @endswitch
        </p>
        <div class="list-order-product">
            <?php $totalPrice = 0 ?>
            @foreach($order->orderDetails as $orderProduct)
            <div class="order-product d-flex align-items-center">
                <a href="#" class="d-flex">
                    <?php $imageFirst = json_decode($orderProduct->product->image)[0] ?>
                    <img src="{{ $imageFirst }}">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="product-name">{{ $orderProduct->product->name }}</p>
                        <p>x{{ $orderProduct->quantity }}</p>
                    </div>
                </a>
                <div class="d-flex align-items-end gap-2">
                    @if($orderProduct->price != $orderProduct->sale_price)
                    <p class="origin-price">{{ number_format($orderProduct->price, "0", "0", ".").' đ' }}</p>
                    @endif
                    <p class="sale-price">{{ number_format($orderProduct->sale_price, "0", "0", ".").' đ' }}</p>
                </div>
            </div>
            <?php $totalPrice += ($orderProduct->sale_price * $orderProduct->quantity) ?>
            @endforeach
        </div>
        <div class="mt-4 row justify-content-end">
            <div class="summary col-12 col-md-5">
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Tổng tiên hàng:</p>
                    <p class="product-total-price">{{ number_format($totalPrice, "0", "0", ".") }} đ</p>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Phí vận chuyển:</p>
                    <p class="shipping-fee">{{ number_format($order->ship_fee, "0", "0", ".") }} đ</p>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Tổng cộng:</p>
                    <p class="total-price">{{ number_format($totalPrice + $order->ship_fee, "0", "0", ".") }} đ</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@stop

@section('js')

@stop