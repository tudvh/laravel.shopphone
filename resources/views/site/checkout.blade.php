@extends('layout.headerOnly')

@section('title', 'Thanh toán')

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/account.css')}}">
<link rel="stylesheet" href="{{url('public/site/css/cart.css')}}">
<link rel="stylesheet" href="{{url('public/site/css/checkout.css')}}">
@stop

@section('main')

<div class="row checkout-wrapper">
    <div class="col-12 col-md-8 px-5">
        <div class="cart">
            <h2>Thông tin sản phẩm</h2>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">Sản phẩm</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->getItems() as $cartItem)
                    <tr class="cart-item" data-index="{{ $cartItem['id'] }}">
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
                            {{ $cartItem['quantity'] }}
                        </td>

                        <td class="text-center total">
                            {{ number_format(($cartItem['salePrice']*$cartItem['quantity']), "0", "0", ".") }} đ
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="account-wrapper checkout col-12 col-md-4">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="" method="POST">
            @csrf

            <h2>Thông tin thanh toán</h2>

            <?php
            $name = $user->last_name . ' ' . $user->first_name;
            $provinceID = $user->ward->district->province->id;
            $districtID = $user->ward->district->id;
            $wardID = $user->ward->id;
            ?>

            <div class="group">
                <small>Họ và tên người nhận</small>
                <input type="text" name="name" placeholder="Họ và tên người nhận..." value="{{ old('name') ? old('name') : ($name ? $name : '') }}">
                @if($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>

            <div class="group">
                <small>Số điện thoại người nhận</small>
                <input type="text" name="phone_number" placeholder="Số điện thoại người nhận..." value="{{ old('phone_number') ? old('phone_number') : ($user->phone_number ? $user->phone_number : '') }}">
                @if($errors->has('phone_number'))
                <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                @endif
            </div>

            <div class="group">
                <small>Tỉnh thành</small>
                <select name="province_id" class="provinces" data-provinceid="{{ old('province_id') ? old('province_id') : ($provinceID ? $provinceID : '') }}">
                    <option value="">--CHỌN TỈNH THÀNH--</option>
                </select>
            </div>

            <div class="group">
                <small>Quận huyện</small>
                <select name="district_id" class="districts" data-districtid="{{ old('district_id') ? old('district_id') : ($districtID ? $districtID : '') }}">
                    <option value="">--CHỌN QUẬN HUYỆN--</option>
                </select>
            </div>

            <div class="group">
                <small>Phường xã</small>
                <select name="ward_id" class="wards" data-wardid="{{ old('ward_id') ? old('ward_id') : ($wardID ? $wardID : '') }}">
                    <option value="">--CHỌN PHƯỜNG XÃ--</option>
                </select>
                @if($errors->has('ward_id'))
                <small class="text-danger">{{ $errors->first('ward_id') }}</small>
                @endif
            </div>

            <div class="group">
                <small>Địa chỉ nhận hàng</small>
                <input type="text" name="address" placeholder="Địa chỉ nhận hàng..." value="{{ old('address') ? old('address') : ($user->address ? $user->address : '') }}">
                @if($errors->has('address'))
                <small class="text-danger">{{ $errors->first('address') }}</small>
                @endif
            </div>

            <div class="group">
                <small>Phương thức thanh toán</small>
                <select name="pay_method">
                    <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                </select>
            </div>

            @if($cart->getTotalQuantity())
            <div class="summary group">
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Tổng tiên hàng:</p>
                    <p class="product-total-price" data-index="{{ $cart->getTotalPrice() }}">{{ number_format(($cart->getTotalPrice()), "0", "0", ".") }} đ</p>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Phí vận chuyển:</p>
                    <input type="hidden" class="shipping-fee-value" name="ship_fee" value="0">
                    <p class="shipping-fee">20.000đ</p>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <p>Tổng cộng:</p>
                    <p class="total-price">12.320.000đ</p>
                </div>
            </div>
            @endif

            <input type="submit" value="Xác nhận thanh toán">
        </form>
    </div>
</div>

@stop

@section('js')
<script src="{{ url('public/site/js/address.js') }}"></script>
<script src="{{ url('public/site/js/checkout.js') }}"></script>
@stop