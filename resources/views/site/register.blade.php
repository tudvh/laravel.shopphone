@extends('layout.site')

@section('title', 'Đăng ký')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/account.css') }}">
@stop

@section('main')

<div class="d-flex justify-content-center row">
    <div class="account-wrapper register col-10">
        <form action="" method="POST">
            @csrf
            <h2>Đăng ký tài khoản</h2>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="group">
                        <small>Họ và tên lót</small>
                        <input type="text" name="last_name" placeholder="Họ và tên lót..." value="{{ old('last_name') }}">
                        @if($errors->has('last_name'))
                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Tên</small>
                        <input type="text" name="first_name" placeholder="Tên..." value="{{ old('first_name') }}">
                        @if($errors->has('first_name'))
                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Giới tính</small>
                        <select name="gender">
                            <option value="m">Nam</option>
                            <option value="w">Nữ</option>
                            <option value="g">Khác</option>
                        </select>
                    </div>

                    <div class="group">
                        <small>Số điện thoại</small>
                        <input type="text" name="phone_number" placeholder="Số điện thoại..." value="{{ old('phone_number') }}">
                        @if($errors->has('phone_number'))
                        <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Email</small>
                        <input type="email" name="email" placeholder="Email..." value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Tài khoản</small>
                        <input type="text" name="username" placeholder="Tài khoản..." value="{{ old('username') }}">
                        @if($errors->has('username'))
                        <small class="text-danger">{{ $errors->first('username') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Mật khẩu</small>
                        <input type="password" name="password" placeholder="Mật khẩu..." value="{{ old('password') }}" autocomplete="off">
                        @if($errors->has('password'))
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Xác nhận mật khẩu</small>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu..." value="{{ old('confirm_password') }}" autocomplete="off">
                        @if($errors->has('confirm_password'))
                        <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="group">
                        <small>Tỉnh/Thành</small>
                        <select name="province_id" class="provinces" data-provinceid="{{ old('province_id') }}">
                            <option value="">--CHỌN TỈNH THÀNH--</option>
                        </select>
                    </div>

                    <div class="group">
                        <small>Quận/Huyện</small>
                        <select name="district_id" class="districts" data-districtid="{{ old('district_id') }}">
                            <option value="">--CHỌN QUẬN HUYỆN--</option>
                        </select>
                    </div>

                    <div class="group">
                        <small>Phường/Xã</small>
                        <select name="ward_id" class="wards" data-wardid="{{ old('ward_id') }}">
                            <option value="">--CHỌN PHƯỜNG XÃ--</option>
                        </select>
                        @if($errors->has('ward_id'))
                        <small class="text-danger">{{ $errors->first('ward_id') }}</small>
                        @endif
                    </div>

                    <div class="group">
                        <small>Địa chỉ</small>
                        <input type="text" name="address" placeholder="Địa chỉ..." value="{{ old('address') }}">
                        @if($errors->has('address'))
                        <small class="text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="group">
                <input type="submit" value="Đăng ký">
            </div>

            Có tài khoản rồi sao? <a href="{{ route('home.login') }}">Đăng nhập</a>
        </form>
    </div>
</div>

@stop

@section('js')
<script src="{{ url('public/site/js/address.js') }}"></script>
@stop