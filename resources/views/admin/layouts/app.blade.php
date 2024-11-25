<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-Cui6L-4Y.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('style/notify.min.css') }}">
    @yield('header')
</head>

<body>
    @include('admin.includes.header')
    @include('admin.includes.sidebar')

    @yield('contents')

    <script src="{{ asset('script/jquery.js') }}"></script>
    <script src="{{ asset('script/notify.js') }}"></script>
    <script src="{{ asset('script/helpers.js') }}"></script>
    <script src="{{ asset('script/admin.js') }}"></script>
    @include('admin.includes.notify')

    @yield('script')
</body>

</html>
