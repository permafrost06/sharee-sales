<div @class($class) id="{!! $groupId !!}">
    @if ($label)
        <label for="{!! $id !!}"
            class="mb-6 font-nornal text-sm text-slate-700">{!! $label !!}</label>
    @endif
    <div class="relative mb-1">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                viewBox="{{ $svg->attributes->get('viewBox', '0 0 24 24') }}">
                {{ $svg }}
            </svg>
        </div>
        <input id="{!! $id !!}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-blue-500 block w-full pl-10 p-2.5"
            placeholder="{{ $placeholder ?? $label }}" {{ $attributes }} />
    </div>
    @php
        $name = $attributes->get('name', '');
        if (!$hint && $hintType === 'error' && $errors->has($name)) {
            $hint = $errors->first($name);
        }
    @endphp
    @if ($hint)
        <label for="{!! $id !!}" @class([
            'text-xs font-normal leading-normal mt-0',
            'text-red-500' => $hintType == 'error',
            'text-yellow-300' => $hintType == 'warning',
            'text-emerald-600' => $hintType == 'success',
            'text-gray-600' => $hintType == 'none',
        ])>
            {{ $hint }}
        </label>
    @endif
</div>
