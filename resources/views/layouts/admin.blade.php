<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Admin Panel - {{ config('app.page_title') }}</title>
    @vite(['resources/css/app.css', 'resources/js/admin/app.js'])
    @yield('head')
</head>
<body class="flex">
    @include('layouts.inc.admin-sidebar')
    @yield('page')
</body>
</html>