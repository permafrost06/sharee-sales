@php
if ($type === 'none' && !$message) {
    if ($errors->any()) {
        $message = $errors->first();
        $type = 'error';
    } elseif(Session::has('form-alert')) {
        $message = Session::get('form-alert');
        $type = Session::get('form-alert-type', 'success');
    }
}
@endphp
@if ($message)
    <div @class([
        'text-sm px-5 py-2.5 rounded shadow-sm border',
        'bg-emerald-100 text-emerald-600 border-emerald-400' => $type == 'success',
        'bg-yellow-100 text-yellow-600 border-yellow-400' => $type == 'warning',
        'bg-red-100 text-red-600 border-red-400' => $type == 'error',
        'bg-gray-100 text-gray-800 border-gray-400' => $type == 'none',
        ...$class,
    ])>
        {!! $message !!}
    </div>
@endif
