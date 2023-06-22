<button type="{{ $type }}" {{ $attributes }} @class([
    'focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5',
    'text-white bg-accent hover:bg-accentDark focus:ring-accent focus:outline-none' =>
        $variant === 'primary',
    'text-white bg-textPrimary bg-opacity-90 hover:bg-opacity-100 focus:outline-none focus:ring-textPrimary' =>
        $variant === 'dark',
    'text-primary bg-foreground border border-textSecondary focus:outline-none hover:bg-textSecondary hover:bg-opacity-10 focus:ring-textPrimary' =>
        $variant === 'light',
    'focus:outline-none text-white bg-success bg-opacity-90 hover:bg-opacity-100 focus:outline-none focus:ring-textPrimary' =>
        $variant === 'success',
    'focus:outline-none text-white bg-danger bg-opacity-90 hover:bg-opacity-100 focus:outline-none focus:ring-textPrimary' =>
        $variant === 'danger',
    'focus:outline-none text-white bg-warning bg-opacity-90 hover:bg-opacity-100 focus:outline-none focus:ring-textPrimary' =>
        $variant === 'warning',
    ...$class
])>
    {{ $slot }}
</button>
