@extends('admin.layouts.app')

@section('header')
@endsection

@section('contents')
    <main class="lg:ml-[254px] flex flex-col flex-grow">


        <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900 ">
            <div class="mb-4 col-span-full xl:mb-2 mt-16">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="#"
                                    class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Profile</a>
                            </div>
                        </li>

                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Profile settings</h1>
            </div>
            <!-- Right Content -->
            <div class="col-span-full xl:col-auto">
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="flex flex-col gap-3 w-full">
                        <button class="btn" id="profileBtn" onclick="toggleProfiles('profile')">Profile
                            information</button>
                        <button class="btn-outline" id="passwordBtn" onclick="toggleProfiles('password')">Update
                            password</button>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div class=" p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
                    id="profileInfo">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
                    <form id="ProfileForm">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Username" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Email" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="uid"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User id</label>
                                <input type="uid" name="uid" id="uid"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="User id" value="{{ auth()->user()->uid }}">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="country"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile
                                    image</label>
                                <input type="file" name="profile" id="profile"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="country"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roles</label>
                                <div class="flex gap-1.5 flex-wrap">
                                    @forelse (auth()->user()->roles as $role)
                                        <span class="badge badge-blue">{{ $role->name }}</span>
                                    @empty 
                                        <span class="badge badge-green">Default</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="country"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
                                <div class="flex gap-1.5 flex-wrap">
                                    @forelse (auth()->user()->roles as $role)
                                        
                                        @forelse ($role->permissions as $permission)
                                        <span class="badge badge-blue">{{ $permission->name }}</span>
                                        @empty
                                            <span class="badge badge-green">Default</span>
                                        @endforelse
                                    @empty 
                                    
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <button
                            class="mt-5 w-full flex-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit" id="submitBtn">Update Profile</button>
                    </form>
                </div>

                <div class="hidden p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
                    id="passwordDiv">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Password information</h3>
                    <form id="PasswordFrom">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                    password</label>
                                <input type="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="••••••••" name="password">

                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="confirm-password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                    password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="••••••••">

                            </div>
                        </div>
                        <button
                            class="mt-5 w-full flex-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit" id="updateBtn">Update Password</button>
                    </form>
                </div>

            </div>

        </div>

    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#ProfileForm').on('submit', function(e) {
                e.preventDefault();
                var submitBtn = $('#submitBtn');
                $('.text-red-500').remove();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('dashboard.updateProfile') }}",
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                        submitBtn.html(loader)
                    },
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update Profile");
                        if (response.status === 'success') {
                            notyf.success(response.data.message);
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update Profile");

                        let errors = xhr.responseJSON;

                        if (errors.status == 'error') {
                            $.each(errors.data.errors, function(key, value) {
                                let inputField = $(`#${key}`);
                                inputField
                                    .after(
                                        `<p class="text-red-500 text-sm mt-1">${value[0]}</p>`
                                    );
                            });
                        }
                    }
                });
            });

            $('#PasswordFrom').on('submit', function(e) {
                e.preventDefault();
                var submitBtn = $('#updateBtn');
                $('.text-red-500').remove();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('dashboard.updatePassword') }}", // Ensure this route is defined in your Laravel app
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                        submitBtn.html(loader);
                    },
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update Password");
                        if (response.status === 'success') {
                            notyf.success(response.data.message);
                            $('#PasswordFrom')[0].reset(); // Clear the form
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update Password");

                        let errors = xhr.responseJSON;

                        if (errors.status == 'error') {
                            $.each(errors.data.errors, function(key, value) {
                                let inputField = $(`[name="${key}"]`);
                                inputField
                                    .after(
                                        `<p class="text-red-500 text-sm mt-1">${value[0]}</p>`
                                    );
                            });
                        }
                    }
                });
            });


        });
    </script>
@endsection
