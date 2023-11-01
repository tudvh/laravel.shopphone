<header>
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{route('home.index')}}" class="header-logo">
            <img src="{{url('public/imgs/logo.png')}}" alt="TNT Shop">
        </a>

        <nav>
            <ul class="d-flex">
                <li><a href="{{route('home.index')}}" class="text-uppercase">trang chủ</a></li>
                <li><a href="#footer" class="text-uppercase">liên hệ</a></li>
            </ul>
        </nav>

        <form action="{{ route('home.index') }}" class="header-search d-flex align-items-center">
            <input type="text" name="search" placeholder="Tìm kiếm..." value="@if(isset($searchKey)){{$searchKey}}@endif" autocomplete="off">
            <button><i class="fas fa-search"></i></button>
        </form>

        <div class="header-cart">
            <a href="{{ route('cart.view') }}"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>

        <input type="checkbox" class="user-check" id="user-check">
        <div class="header-user">
            @if(Auth::guard('cus')->check())
            <label for="user-check">
                <i class="fa-solid fa-user"></i>
            </label>
            <ul class="menu">
                <li><a class="user-name">{{ Auth::guard('cus')->user()->last_name }} {{ Auth::guard('cus')->user()->first_name }}</a></li>
                <li><a href="#">Cài đặt tài khoản</a></li>
                <li><a href="{{ route('home.order.view') }}">Đơn mua</a></li>
                <li><a href="#">Đổi mật khẩu</a></li>
                <li><a href="{{ route('home.logout') }}">Đăng xuất</a></li>
            </ul>
            @else
            <span><a href="{{ route('home.login') }}" class="action">Đăng Nhập</a></span>
            <span><a href="{{ route('home.register') }}" class="action">Đăng ký</a></span>
            @endif
        </div>
        <label class="overlay" for="user-check"></label>
    </div>
</header>