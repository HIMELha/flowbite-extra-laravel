<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- @vite('resources/css/app.css') --}}

    <link rel="stylesheet" href="{{ asset('build/assets/app-D2h36hjG.css') }}">

</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center max-w-lg mx-auto">
        <h1 class="text-8xl font-bold text-red-600">@yield('code')</h1>
        <h2 class="text-3xl font-semibold text-gray-800 mt-4">@yield('title')</h2>
        <p class="text-gray-600 mt-2">@yield('message')</p>
        <div class="mt-6">
            <a href="{{ route('dashboard.index') }}"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go to Home</a>
            <a href="javascript:history.back()" class="px-6 py-2 bg-gray-800 text-white rounded hover:bg-slate-900">Go
                Back</a>
        </div>
    </div>
</body>

</html>
