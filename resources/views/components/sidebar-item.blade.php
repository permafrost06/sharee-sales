<li class="my-2">
    <a href="{{ $link }}" @class([
        'flex items-center p-2 collapsed:md:max-w-min hover:bg-blue-50 rounded-md',
        'bg-admin-nav-active text-active' => Route::currentRouteName() == $route,
    ])>
        @isset($svg)
            <svg class="mr-2 collapsed:md:mr-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="{{ $svg->attributes->get('viewBox', '0 0 24 24') }}">
                {{ $svg }}
            </svg>
        @endisset
        <div class="flex-grow font-medium text-sm collapsed:md:hidden">
            {{ $slot }}
        </div>
    </a>
</li>
