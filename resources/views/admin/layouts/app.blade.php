<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flowbite Extra Admin Dashboard Template</title>
    @vite('resources/css/app.css')
    @yield('header')
</head>

<body>
    @include('admin.includes.header')
    @include('admin.includes.sidebar')

    <div class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop">
        @yield('contents')
    </div>

    <script src="{{ asset('script/admin.js') }}"></script>
    @yield('script')
</body>

</html>
