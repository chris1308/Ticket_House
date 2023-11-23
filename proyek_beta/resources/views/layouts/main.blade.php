<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Testing for Social share">
    <meta property="og:description" content="Description of your ticket">
    <meta property="og:image" content="URL_to_an_image">
    <meta property="fb:app_id" content="863164778768127" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font/font/css/all.min.css') }}">
    <style>
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999; /* Ensure it appears above other elements */
        }


    </style>
    <title>{{ $title }}</title>
</head>
<body>
    
    <div id="loader">
        <div class="wrapper d-flex justify-content-center" style="padding-top: 10%">
            <img style="width:500px;" src="{{ asset('images/loader2.gif') }}" alt="Loader">
        </div>
    </div>
    {{-- navbar dijadikan komponen terpisah di file partials/navbar. Cara panggil komponen pake @include(namafolder.namafile) --}}
    @include('partials.navbar')
    <div class="container-fluid" style="">
        @yield('content')
    </div>
    @include('partials.footer')
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=863164778768127" nonce="YOUR_RANDOM_NONCE"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>
</body>
</html>