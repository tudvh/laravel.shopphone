<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/'); }}">
    <meta name="curent-url" data-index="{{ URL::current() }}">
    @yield('meta')
    <title>@yield('title') | TNT Shop</title>
    <!-- Link icon web -->
    <link rel="SHORTCUT ICON" href="{{ asset('public/imgs/logo_title.png') }}">
    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link css local -->
    <link rel="stylesheet" href="{{ url('public/site/css/site.css') }}">
    @yield('css')
</head>

<body>
    <!-- Header -->
    @include('component.header')

    <!-- Main -->
    <div id="main">
        <div class="container">
            <div class="row gap-4 gap-md-0">

                <!-- Side bar -->
                <div class="px-3 col-12 col-md-3">
                    <div class="side-bar">
                        <ul class="menu-item menu-item-1">
                            @foreach($listCategory as $category)
                            <li>
                                <input type="checkbox" class="menu-check hidden" id="menu-check-{{ $category['slug'] }}" @if(isset($categoryChecked) && $categoryChecked->id==$category['id']) checked @endif>
                                <label for="menu-check-{{ $category['slug'] }}">
                                    <p>{{ $category['name'] }}</p>
                                    <div class="menu-icon">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </label>
                                <ul class="menu-item menu-item-2">
                                    @foreach($category['listBrand'] as $brand)
                                    <li>
                                        <label class="@if(isset($categoryChecked) && $categoryChecked->id==$category['id'] && $brandChecked->id==$brand['id']) active @endif">
                                            <a href="{{ route('home.category.brand', ['categorySlug'=>$category['slug'], 'brandSlug'=>$brand['slug']]) }}">{{ $brand['name'] }}</a>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Content -->
                <div class="col-12 col-md-9">
                    <div id="content">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    @include('component.footer')

    <!-- Link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link js jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Link js local -->
    <script src="{{url('public/site/js/site.js')}}"></script>
    @yield('js')
</body>

</html>