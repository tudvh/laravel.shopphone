<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNT Shop | @yield('title')</title>
    <!-- Link icon web -->
    <link rel="SHORTCUT ICON" href="{{asset('public/imgs/logo_title.png')}}">
    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Link css local -->
    <link rel="stylesheet" href="{{url('public/site/css/site.css')}}">
    <link rel="stylesheet" href="{{url('public/site/css/site-respon.css')}}">
    @yield('css')
</head>

<body>
    <!-- Header -->
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

            <form action="#" class="header-search d-flex align-items-center">
                <input type="text" name="search" placeholder="Tìm kiếm...">
                <button><i class="fas fa-search"></i></button>
            </form>

            <div class="header-cart">
                <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
            </div>

            <input type="checkbox" class="user-check" id="user-check">
            <div class="header-user">
                <!-- <label for="user-check">
                    <i class="fa-solid fa-user"></i>
                </label>
                <ul class="menu">
                    <li><a href="#">Xin chào Tus</a></li>
                    <li><a href="#">Đơn mua</a></li>
                    <li><a href="#">Đổi mật khẩu</a></li>
                    <li><a href="#">Đăng xuất</a></li>
                </ul> -->

                <span><a href="#" class="action">Đăng Nhập</a></span>
                <span><a href="#" class="action">Đăng ký</a></span>
            </div>
            <label class="overlay" for="user-check"></label>
        </div>
    </header>

    <!-- Main -->
    <div id="main">
        <div class="container">
            <div class="row">

                <!-- Side bar -->
                <ul class="side-bar col-3">
                    @foreach($listCategory as $category)
                    <li>
                        <input type="checkbox" class="check-menu hidden" id="menu-plus-{{ $category['id'] }}">
                        <label for="menu-plus-{{ $category['id'] }}" class="menu-item menu-item-1">
                            <p>{{ $category['name'] }}</p>
                            <div class="icon-menu">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </label>

                        <ul class="menu-item menu-item-2">
                            @foreach($category['listBrand'] as $brand)
                            <li>
                                <a href="#">{{ $brand['name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>

                <!-- Main -->
                <div class="col-9" id="content">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <footer id="footer" class="text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Liên hệ</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="https://www.facebook.com/toanf2103" class="text-white" target="blank">Nguyễn Đắc Toàn</a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/v0ph0n9nh4" class="text-white" target="blank">Võ Phong Nhã</a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/dangvanhoaitu/" class="text-white" target="blank">Đặng Văn Hoài Tú</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Đồng hồ</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <span id="dong_ho"></span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Địa chỉ</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1645.1392179099182!2d108.2119881808514!3d16.077492662997614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142184792140755%3A0xd4058cb259787dac!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBTxrAgUGjhuqFtIEvhu7kgdGh14bqtdCAtIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e1!3m2!1svi!2s!4v1641888639685!5m2!1svi!2s" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" onload="setInterval(dong_ho, 1000);"></iframe>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © Copyright <?php echo date('Y') ?>
        </div>
    </footer>

    <!-- Link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>