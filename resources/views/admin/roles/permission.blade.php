@extends('admin.layouts.app')

@section('header')
@endsection

@section('contents')
    <main class="lg:ml-[254px] flex flex-col flex-grow ">


        <div class=" p-4 bg-white flex flex-col items-center justify-between lg:mt-1.5 ">
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
                                        class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Permission</a>
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
                                        aria-current="page">List</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage roles & permission
                    </h1>
                    <form action="{{ route('roles.permissions') }}" method="GET">

                        <div class="relative lg:w-64 xl:w-96">
                            <input type="text" name="search" id=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search for permission" value="{{ $search }}">

                            <button type="submit"
                                class="absolute right-0 bottom-0 top-0 w-10 h-full  text-base font-medium text-center text-white bg-slate-900 rounded hover:bg-gray-800 focus:ring-4 focus:ring-blue-300"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>


                    </form>

                    <a href="{{ route('roles.createPermission') }} " class="btn !py-1.5">New permission</a>
                </div>
            </div>




        </div>

        <div class="flex flex-col w-full px-4">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Permission name
                                    </th>

                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <tbody class="bg-white dark:bg-gray-800">
                                        <tr>
                                            <td
                                                class="px-4 py-2 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">

                                                {{ $permission->name }}
                                            </td>

                                            

                                            <td class="p-2 flex gap-3 whitespace-nowrap">
                                                <a href="{{ route('roles.editPermission', $permission->id) }}" class="btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a href="{{ route('roles.deletePermission', $permission->id) }}" class="btn-sm !bg-red-500">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                            No permissions found.
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 py-2">
            {{ $permissions->links() }}
        </div>


    </main>
@endsection

@section('script')
@endsection
