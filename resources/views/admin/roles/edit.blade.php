@extends('admin.layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('style/select2.min.css') }}">
@endsection

@section('contents')
    <main class="lg:ml-[254px] flex flex-col flex-grow ">


        <div
            class=" p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
            <div class="w-full mb-1 mt-16">
                <div class="mb-4">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="#"
                                    class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
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
                                        class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Roles</a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                        aria-current="page">Edit</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Edit Roles</h1>
                </div>


                <div class="p-6 space-y-6">
                    <form id="RoleUpdateForm" >
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" value="Bonnie" id="name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500"
                                    placeholder="Bonnie">
                            </div>
                            <div class="col-span-6 sm:col-span-3 w-full">
                                <label for="roles"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select role</label>
                                <select name="roles[]" class="w-full" id="roles_select" multiple>
                                    @forelse ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @empty
                                        <option selected disabled>No roles found</option>
                                    @endforelse
                                </select>

                            </div>



                        </div>
                </div>
                <!-- Modal footer -->
                <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        class="w-full flex-center text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800"
                        type="submit" id="submitBtn">Update User</button>
                </div>
                </form>
            </div>
        </div>





    </main>
@endsection

@section('script')
    <script src="{{ asset('script/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#roles_select').select2();

            $('#RoleUpdateForm').on('submit', function(e) {
                e.preventDefault();
                var submitBtn = $('#submitBtn');
                $('.text-red-500').remove();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('roles.update', $user->id) }}",
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
                        submitBtn.html("Update User");
                        if (response.status == 'success') {
                            notyf.success(response.data.message);

                            setTimeout(() => {
                                redirect(response.data.redirect);
                            }, 1000);
                        }

                        if(response.status == 'error'){
                            notyf.error(response.data.message);

                            setTimeout(() => {
                                redirect(response.data.redirect);
                            }, 1000);
                        }

                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update User");

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
        });
    </script>
@endsection
