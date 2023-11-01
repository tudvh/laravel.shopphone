@extends('layout.site')

@section('title', 'Đăng nhập')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/account.css') }}">
@stop

@section('main')

<div class="d-flex justify-content-center row">
    <div class="account-wrapper col-5">
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

        <form action="" method="POST">
            @csrf
            <input type="hidden" name="link_previous" value="{{ url()->previous() }}">

            <h2>ĐĂNG NHẬP CỬA HÀNG</h2>

            <div class="group">
                <small>Tài khoản</small>
                <input type="text" name="username" placeholder="Tài khoản..." value="{{ old('username') }}">
                @if($errors->has('username'))
                <small class="text-danger">{{ $errors->first('username') }}</small>
                @endif
            </div>

            <div class="group">
                <small>Mật khẩu</small>
                <input type="password" name="password" placeholder="Mật khẩu..." autocomplete="off">
                @if($errors->has('password'))
                <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <div class="group form-check d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" name="remember" id="remember-check">
                <label class="form-check-label" for="remember-check">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            <div class="group">
                <input type="submit" value="Đăng nhập">
            </div>

            <a href="#" class="mt-3">Quên mật khẩu?</a>
            <br>
            Chưa có tài khoản ư? <a href="{{ route('home.register') }}">Đăng ký tài khoản</a>
        </form>
    </div>
</div>


@stop