<div @class($class) id="{!!$groupId!!}">
    @if ($label)
    <label for="{!!$id!!}" class="mb-2 ml-1 font-bold text-xs text-textPrimary text-opacity-90">{!!$label!!}</label>
    @endif
    <input
        id="{!!$id!!}"
        class="text-sm leading-5.6 block w-full appearance-none rounded-lg border border-solid border-textSecondary bg-transparent px-3 py-2 font-normal text-textPrimary transition-all focus:border-accent focus:outline-none focus:shadow-input focus:shadow-accent"
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
            'text-xs font-normal leading-normal mt-0',
            'text-danger' => $hintType == 'error',
            'text-warning' => $hintType == 'warning',
            'text-success' => $hintType == 'success',
            'text-textSecondary' => $hintType == 'none',
        ])>
        {{$hint}}
    </label>
    @endif
</div>