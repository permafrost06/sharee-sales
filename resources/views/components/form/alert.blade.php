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
        'text-success bg-success bg-opacity-10 border-success' => $type == 'success',
        'text-warning bg-warning bg-opacity-10 border-warning' => $type == 'warning',
        'text-danger bg-danger bg-opacity-10 border-danger' => $type == 'error',
        'text-textPrimary bg-textPrimary bg-opacity-10 border-textPrimary' => $type == 'none',
        ...$class,
    ])>
        {!! $message !!}
    </div>
@endif
