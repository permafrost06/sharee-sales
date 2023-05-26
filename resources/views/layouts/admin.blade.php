<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Admin Panel - {{ config('app.page_title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/admin/app.js'])
    @yield('head')
</head>

<body class="flex bg-body text-main font-main">
    @include('layouts.inc.admin-sidebar')
    <main class="flex-grow">
        <nav class="flex h-admin-nav bg-admin-nav border-b px-10 items-center relative">
            <form class="flex items-center flex-grow">
                <label for="nav-search" class="sr-only">Search</label>
                <div class="relative min-w-none md:min-w-lg">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="nav-search"
                        class="border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Search anything..." required>
                </div>
            </form>
            <ul class="flex items-center space-x-3">
                <li>
                    <button type="button"
                        class="hover:bg-admin-nav-active hover:text-active focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-1 text-center inline-flex items-center relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3H4a4 4 0 0 0 2-3v-3a7 7 0 0 1 4-6M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="sr-only">Notification</span>
                        <div
                            class="absolute inline-flex items-center justify-center w-6 h-6 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1">
                            20</div>
                    </button>
                </li>
                <li>
                    <button type="button"
                        class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-10 h-10 rounded-full" src="https://source.unsplash.com/random/200x200"
                            alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow top-full right-8 mt-2 absolute"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">Saad</span>
                            <span
                                class="block text-sm  text-gray-500 truncate">sakib.saad.khan@gmail.com</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Earnings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                    out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        @yield('page')
    </main>
</body>

</html>
