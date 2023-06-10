<div @class($class) id="{!!$groupId!!}">
    @if ($label)
    <label for="{!!$id!!}" class="mb-2 ml-1 font-bold text-xs text-slate-700">{!!$label!!}</label>
    @endif
    <input
        id="{!!$id!!}"
        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
        placeholder="{{$placeholder??$label}}" {{$attributes}}/>
    @php
        $name = $attributes->get('name', '');
        if (
            !$hint &&
            $hintType === 'error' &&
            $errors->has($name)
        ) {
            $hint = $errors->first($name);
        }
    @endphp
    @if ($hint)
    <label
        for="{!!$id!!}"
        @class([
            "text-xs font-normal leading-normal mt-0",
            'text-red-500' => $hintType == 'error',
            'text-yellow-300' => $hintType == 'warning',
            'text-emerald-600' => $hintType == 'success',
            'text-gray-600' => $hintType == 'none'
        ])>
        {{$hint}}
    </label>
    @endif
</div>