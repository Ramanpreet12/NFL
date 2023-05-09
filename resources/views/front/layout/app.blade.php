<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('css')

    @if (!empty($general->favicon))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/general/' . $general->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="">
    @endif

    <title>NFL</title>

</head>

<body>
    @include('front.layout.header')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('front.layout.footer')

</body>

</html>
