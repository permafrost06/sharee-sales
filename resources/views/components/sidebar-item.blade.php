<li class="my-2">
    <a href="#" @class([
        'flex items-center p-2 collapsed:md:max-w-min',
        'rounded-md bg-admin-nav-active text-active' => $active,
    ])>
        @isset($svg)
            <svg class="mr-2 collapsed:md:mr-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="{{$svg->attributes->get('viewBox', '0 0 24 24')}}">
                {{ $svg }}
            </svg>
        @endisset
        <div class="flex-grow font-medium collapsed:md:hidden">
            {{ $slot }}
        </div>
    </a>
</li>
