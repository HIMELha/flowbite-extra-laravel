@extends('admin.layouts.app')

@section('header')
@endsection

@section('contents')
    <main class="lg:ml-[254px] flex flex-col flex-grow">


        <div class="px-4 pt-6 dark:bg-gray-900 ">
            <div class="mb-4 xl:mb-2 mt-16">
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
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Settings</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Site settings</h1>
            </div>

            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
                <form id="SettingsForm" enctype="multipart/form-data">
                    <div class="grid grid-cols-6 gap-4">
                        <!-- Site Name -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="site_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site
                                Name</label>
                            <input type="text" name="site_name" id="site_name"
                            value="{{ setting('site_name') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Site Name">
                        </div>

                        <!-- Site Title -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="site_title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site Title</label>
                            <input type="text" name="site_title" id="site_title" value="{{ setting('site_title') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Site Title">
                        </div>

                        <!-- Site Logo -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="site_logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site
                                Logo</label>
                            <input type="file" name="site_logo" id="site_logo"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="col-span-6 sm:col-span-3 flex-center">
                            @if(fileExists(setting('site_logo')))
                            <img src="{{ asset(setting('site_logo')) }}" alt="site logo" class="w-12 h-auto">
                            @else
                            <img src="{{ asset('images/site_logo.svg') }}" alt="site logo" class="w-12 h-auto">
                            @endif
                        </div>

                        <!-- Site Description -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="site_description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site
                                Description</label>
                            <input type="text" name="site_description" id="site_description"
                                value="{{ setting('site_description') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Site Description">
                        </div>

                        <!-- Contact Info -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="contact_info"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Info</label>
                            <input type="text" name="contact_info" id="contact_info"
                                value="{{ setting('contact_info') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Contact Info">
                        </div>

                        <!-- Facebook Link -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="facebook_link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook Link</label>
                            <input type="text" name="facebook_link" id="facebook_link"
                                value="{{ setting('facebook_link') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Facebook Link">
                        </div>

                        <!-- YouTube Link -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="youtube_link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">YouTube Link</label>
                            <input type="text" name="youtube_link" id="youtube_link"
                                value="{{ setting('youtube_link') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="YouTube Link">
                        </div>

                        <!-- Twitter Link -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="twitter_link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Twitter Link</label>
                            <input type="text" name="twitter_link" id="twitter_link"
                                value="{{ setting('twitter_link') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Twitter Link">
                        </div>

                        <!-- WhatsApp Link -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="whatsapp_link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">WhatsApp Link</label>
                            <input type="text" name="whatsapp_link" id="whatsapp_link"
                                value="{{ setting('whatsapp_link') }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="WhatsApp Link">
                        </div>

                        <div class="col-span-6 flex justify-end items-end">
                            <button class="btn w-[200px] text-center flex-center" type="submit" id="submitBtn">Update setting</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


            $('#SettingsForm').on('submit', function(e) {
                e.preventDefault();
                var submitBtn = $('#submitBtn');
                $('.text-red-500').remove();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('settings.update') }}",
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
                        submitBtn.html("Update setting");
                        if (response.status == 'success') {
                            notyf.success(response.data.message);

                            setTimeout(() => {
                                redirect(response.data.redirect);
                            }, 1000);
                        }

                        if (response.status == 'error') {
                            notyf.error(response.data.message);

                            setTimeout(() => {
                                redirect(response.data.redirect);
                            }, 1000);
                        }

                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        submitBtn.html("Update setting");

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
