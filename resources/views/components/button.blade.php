<button type="{{ $type }}" {{ $attributes }} @class([
    'focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5',
    'text-white bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 focus:outline-none' =>
        $variant === 'primary',
    'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300' =>
        $variant === 'dark',
    'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-gray-200' =>
        $variant === 'light',
    'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-green-300' =>
        $variant === 'success',
    'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-red-300' =>
        $variant === 'danger',
    'focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-300' =>
        $variant === 'warning',
    ...$class
])>
    {{ $slot }}
</button>
