@extends('layout.site')

@section('title', 'Thanh toán')

@section('css')

@stop

@section('main')

<div class="p-5 mb-4 bg-white rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Đặt hàng thành công</h1>
        <p class="col-md-8 fs-4">Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ bạn trong một ít phút. Cảm ơn bạn đã mua sản phẩm của chúng tôi <3</p>
        <a class="btn btn-primary btn-lg" href="{{ route('home.index') }}">Tiếp tục mua hàng</a>
        <a class="btn btn-primary btn-lg ms-5" href="{{ route('home.order.view', ['type'=>1]) }}">Xem đơn mua</a>
    </div>
</div>

@stop

@section('js')

@stop