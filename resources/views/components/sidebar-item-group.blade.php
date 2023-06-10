<li class="my-2">
    <div 
        @class([
            'flex items-center p-2 collapsed:md:max-w-min hover:bg-blue-50 rounded-md cursor-pointer',
            'text-active' => $isActive,
        ])
        data-collapse="#{{$g_id}}"
        data-expand="#{{$g_id}}"
    >
        @isset($svg)
            <svg class="mr-2 collapsed:md:mr-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="{{ $svg->attributes->get('viewBox', '0 0 24 24') }}">
                {{ $svg }}
            </svg>
        @endisset
        <div class="flex-grow font-medium text-sm collapsed:md:hidden">
            {{ $label }}
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
            <path fill="currentColor"
                d="m216.49 104.49l-80 80a12 12 0 0 1-17 0l-80-80a12 12 0 0 1 17-17L128 159l71.51-71.52a12 12 0 0 1 17 17Z" />
        </svg>
    </div>
    <ul
        id="{{$g_id}}"
        @class([
            "ml-1 pl-1 border-l-2 overflow-y-hidden",
            "hidden" => !$isActive
        ])
    >{{ $slot }}</ul>
</li>
