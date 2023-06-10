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
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet"
    />
    @vite(['resources/css/app.css', 'resources/js/pages/admin/app.js'])
    @yield('head')
</head>

<body class="flex bg-body text-main font-main">
    @include('layouts.inc.admin-sidebar')
    <main class="flex-grow">
        <nav class="flex h-admin-nav bg-admin-nav border-b px-10 items-center relative">
            <button type="button" id="sidenav-opener" class="md:hidden mr-4 p-1 border rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                        stroke-width="48" d="M88 152h336M88 256h336M88 360h336" />
                </svg>
                <div class="sr-only">Open Sidenav</div>
            </button>
            <div class="flex-grow"></div>
            <ul class="flex items-center space-x-3">
                <li>
                    <button type="button"
                        class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                        id="user-menu-button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-10 h-10 rounded-full" src="https://source.unsplash.com/random/200x200"
                            alt="">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden z-50 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow top-full right-8 mt-2 absolute"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                            <span class="block text-sm  text-gray-500 truncate">{{ auth()->user()->email }}</span>
                        </div>
                        <ul aria-labelledby="user-menu-button">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                        type="submit">
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="p-4 md:p-8">
            @yield('page')
        </div>
    </main>
</body>

</html>
