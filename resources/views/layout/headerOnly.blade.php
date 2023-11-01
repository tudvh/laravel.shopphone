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
    <link rel="SHORTCUT ICON" href="{{asset('public/imgs/logo_title.png')}}">
    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Link css local -->
    <link rel="stylesheet" href="{{url('public/site/css/site.css')}}">
    @yield('css')
</head>

<body>
    <!-- Header -->
    @include('component.header')

    <!-- Main -->
    <div id="main">
        <div class="container">
            <!-- Content -->
            <div id="content">
                @yield('main')
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    @include('component.footer')

    <!-- Link js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- Link js jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Link js local -->
    <script src="{{url('public/site/js/site.js')}}"></script>
    @yield('js')
</body>

</html>