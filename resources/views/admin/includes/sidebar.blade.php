<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 ">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 ">
                <ul class="pb-2 space-y-1">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center p-2 text-base text-gray-800 rounded hover:bg-slate-800 hover:text-white {{ routeInArray(['dashboard.index']) == true ? 'bg-slate-800 text-white' : '' }} group">
                            <svg class="w-6 h-6 transition duration-75  " fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                        </a>
                    </li>
                    @if (hasAccess(auth()->user()->roles, ['manage_users']))
                        @php
                            $usersActive = routeInArray(['user.index', 'user.show']);
                        @endphp
                        <li>
                            <button type="button" onclick="toggleMenu(this)"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded group  hover:bg-slate-800 hover:text-white {{ $usersActive ? 'bg-slate-800 text-white' : '' }}">
                                <i class="fa-regular fa-user flex-center icon "></i>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">Users</span>
                                <i
                                    class="fa-solid fa-chevron-up text-[14px] transition-all  px-1.5 {{ $usersActive ? 'rotate-360' : 'rotate-180' }}"></i>
                            </button>
                            <ul id="dropdown-layouts" class="{{ $usersActive ? '' : 'hidden' }} py-2 space-y-1">
                                <li>
                                    <a href="{{ route('user.index') }}"
                                        class="flex items-center p-2 text-base text-gray-900 hover:bg-slate-800 hover:text-white transition duration-75 rounded pl-11 group {{ routeInArray(['user.index']) ? 'bg-slate-800 text-white' : '' }}">User
                                        lists</a>
                                </li>
                                <li>
                                    <a href=""
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Suspended
                                        users</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (hasAccess(auth()->user()->roles, ['manage_categories']))
                        @php
                            $categoriesActive = routeInArray(['categories.index', 'categories.create']);
                        @endphp
                        <li>
                            <button type="button" onclick="toggleMenu(this)"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded group  hover:bg-slate-800 hover:text-white {{ $categoriesActive ? 'bg-slate-800 text-white' : '' }}">
                                <i class="fa-solid fa-list icon"></i>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap"
                                    sidebar-toggle-item>Categories</span>
                                <i class="fa-solid fa-chevron-up text-[14px] transition-all rotate-180 px-1.5"></i>
                            </button>
                            <ul id="dropdown-crud" class="space-y-1 py-2 {{ $categoriesActive ? '' : 'hidden' }}">
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['categories.index']) ? 'bg-slate-800 text-white' : '' }}">Category
                                        lists</a>
                                </li>
                                <li>
                                    <a href="{{ route('categories.create') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['categories.create']) ? 'bg-slate-800 text-white' : '' }}">Create
                                        category</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (hasAccess(auth()->user()->roles, ['manage_pages']))
                        @php
                            $pagesActive = routeInArray([
                                'pages.pricing',
                                'pages.maintenance',
                                'pages.fourzerofour',
                                'pages.fivezerozero',
                            ]);
                        @endphp
                        <li>
                            <button type="button" onclick="toggleMenu(this)"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded group  hover:bg-slate-800 hover:text-white {{ $pagesActive ? 'bg-slate-800 text-white' : '' }}">
                                <svg class="flex-shrink-0 w-6 h-6  transition duration-75 " fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Pages</span>
                                <i class="fa-solid fa-chevron-up text-[14px] transition-all rotate-180 px-1.5"></i>
                            </button>
                            <ul id="dropdown-pages" class="hidden py-2 space-y-1 {{ $pagesActive ? '' : 'hidden' }}">
                                <li>
                                    <a href="{{ route('pages.pricing') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Pricing</a>
                                </li>
                                <li>
                                    <a href="{{ route('pages.maintenance') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Maintenance</a>
                                </li>
                                <li>
                                    <a href="{{ route('pages.fourzerofour') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">404
                                        not found</a>
                                </li>
                                <li>
                                    <a href="{{ route('pages.fivezerozero') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">500
                                        server error</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (hasAccess(auth()->user()->roles, ['manage_auth']))
                        @php
                            $authActive = routeInArray(['auth.forget', 'auth.reset', 'auth.lock']);
                        @endphp
                        <li>
                            <button type="button" onclick="toggleMenu(this)"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded group  hover:bg-slate-800 hover:text-white {{ $authActive ? 'bg-slate-800 text-white' : '' }}">
                                <svg class="flex-shrink-0 w-6 h-6 transition duration-75  " fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap"
                                    sidebar-toggle-item>Authentication</span>
                                <i class="fa-solid fa-chevron-up text-[14px] transition-all rotate-180 px-1.5"></i>
                            </button>
                            <ul id="dropdown-auth" class="hidden py-2 space-y-1 {{ $authActive ? '' : 'hidden' }}">
                                <li>
                                    <a href="{{ route('auth.forget') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Forgot
                                        password</a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.reset') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Reset
                                        password</a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.lock') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white">Profile
                                        lock</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (hasAccess(auth()->user()->roles, ['manage_roles']))
                        @php
                            $rolesActive = routeInArray([
                                'roles.index',
                                'roles.permissions',
                                'roles.roles',
                                'roles.createUser',
                            ]);
                        @endphp
                        <li>
                            <button type="button" onclick="toggleMenu(this)"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded group  hover:bg-slate-800 hover:text-white {{ $rolesActive ? 'bg-slate-800 text-white' : '' }}">
                                <i class="fa-solid fa-user-shield icon"></i>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Roles &
                                    Permission</span>
                                <i class="fa-solid fa-chevron-up text-[14px] transition-all rotate-180 px-1.5"></i>
                            </button>
                            <ul id="dropdown-auth" class=" py-2 space-y-1 {{ $rolesActive ? '' : 'hidden' }}">
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['roles.index']) ? 'bg-slate-800 text-white' : '' }}">Manage
                                        user roles</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.permissions') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['roles.permissions']) ? 'bg-slate-800 text-white' : '' }}">Permissions</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.roles') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['roles.roles']) ? 'bg-slate-800 text-white' : '' }}">Manage
                                        roles</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.createUser') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded pl-11 group hover:bg-slate-800 hover:text-white {{ routeInArray(['roles.createUser']) ? 'bg-slate-800 text-white' : '' }}">Create
                                        new user</a>
                                </li>
                            </ul>
                        </li>
                    @endif


                    @if (hasAccess(auth()->user()->roles, ['manage_settings']))
                        
                        <li>
                            <a href="{{ route('settings.index') }}"
                                class="flex items-center p-2 text-base text-gray-800 rounded hover:bg-slate-800 hover:text-white {{ routeInArray(['settings.index']) == true ? 'bg-slate-800 text-white' : '' }} group">
                                <svg class="w-6 h-6  transition duration-75"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                                <span class="ml-3" sidebar-toggle-item>Settings</span>
                            </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>

    </div>
</aside>
