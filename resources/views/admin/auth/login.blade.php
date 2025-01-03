<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flowbite Extra Admin Dashboard Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('style/notify.min.css') }}">
    {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-D2h36hjG.css') }}">

</head>

<body>

    <div
        class="flex flex-col items-center justify-center px-6 pt-8 mx-auto pt:mt-0 dark:bg-gray-900 ">
        <a href="" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            @if (fileExists(setting('site_logo')))
                <img src="{{ asset(setting('site_logo')) }}" alt="site logo" class="w-10 h-auto">
            @else
                <img src="{{ asset('images/site_logo.svg') }}" alt="site logo" class="w-10 h-auto">
            @endif

            <span>{{ setting('site_name') }}</span>
        </a>
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800 border">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in to platform
            </h2>
            <form class="mt-8 space-y-6" id="LoginForm">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" id="email" value="superadmin@mail.com"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password" id="password" value="12345678" placeholder=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" name="remember" type="checkbox"
                            class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                    </div>
                    <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost
                        Password?</a>
                </div>
                <button type="submit" class="btn-sky w-full flex-center">Login
                    to your account</button>

            </form>
        </div>

        <div class="my-8 px-5 py-3 border shadow-md rounded-md w-full sm:w-[30rem]">
            <h2 class="text-xl font-medium text-slate-800">Login credentials</h2>

            <div class="mt-3">
                <label for="" class="label underline">Superadmin</label>

                <p class="text-slate-900"><i class="fa-regular fa-envelope mr-2"></i>superadmin@mail.com</p>
                <p class="text-slate-900"><i class="fa-solid fa-lock mr-2"></i>12345678</p>
            </div>

            <div class="mt-3">
                <label for="" class="label underline">Admin</label>

                <p class="text-slate-900"><i class="fa-regular fa-envelope mr-2"></i>admin@mail.com</p>
                <p class="text-slate-900"><i class="fa-solid fa-lock mr-2"></i>12345678</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('script/jquery.js') }}"></script>
    <script src="{{ asset('script/notify.js') }}"></script>
    <script src="{{ asset('script/helpers.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#LoginForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                var submitBtn = $('.btn-sky');

                $.ajax({
                    url: "{{ route('dashboard.verifyLogin') }}",
                    type: 'POST',
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                        submitBtn.html(
                            `<div class="w-6 h-6 border-2 border-dashed rounded-full animate-spin border-white"></div>`
                        )
                    },
                    data: formData,
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html(`Login to your account`)

                        if (response.status == 'success') {
                            notyf.success(response.data.message);

                            setTimeout(() => {
                                redirect(response.data.redirect);
                            }, 1500);
                        }
                    },
                    error: function(xhr, status, error) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html(`Login to your account`)
                        let errors = xhr.responseJSON;

                        if (errors.status == 'error') {
                            notyf.error(errors.data.error);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
