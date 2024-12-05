<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Flowbite Extra Admin Dashboard Template</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="w-full h-auto my-20 flex-center flex-col gap-4">
    <h2 class="text-3xl font-medium text-slate-800">Flowbite Extra Admin Dashboard</h2>

    <div class="flex-center gap-4  mt-8 mb-5">
        <a href="{{ route('dashboard.index') }}" class="btn">View demo</a>
        <a href="https://github.com/HIMELha/flowbite-extra-laravel" class="btn-outline">Give a star</a>
    </div>

    <div class="flex flex-col max-w-[1000px] mx-auto gap-3">
        <h2 class="text-2xl font-medium text-center">Screenshots</h2>

        <img src="{{ asset('images/admindashboard1.png') }}" alt="Laravel admin dashboard" class="px-3 rounded-lg border">

        <img src="{{ asset('images/admindashboard2.png') }}" alt="Laravel admin dashboard" class="px-3 rounded-lg border">

        <img src="{{ asset('images/admindashboard3.png') }}" alt="Laravel admin dashboard" class="px-3 rounded-lg border">

        <img src="{{ asset('images/admindashboard4.png') }}" alt="Laravel admin dashboard" class="px-3 rounded-lg border">

        <img src="{{ asset('images/admindashboard5.png') }}" alt="Laravel admin dashboard" class="px-3 rounded-lg border">
    </div>

    <div class="flex flex-col mt-10 items-center">
        <span>Extended version of flowbite admin dashboard template</span>
        <p>All rights are reserved by Himel Hasan</p>
    </div>
</body>

</html>
