@extends('layouts.admin')
@section('page')
    <div class="mb-6 text-gray-600">
        <x-breadcrumb :home="[
            'route' => 'admin.index',
            'label' => 'Home',
        ]" :items="[]" active="Tada" />
    </div>

    <h3 class="text-lg font-semibold text-dark mb-4">Dashboard</h3>

    <div class="grid grid-cols-2">
        <x-card class="p-4">Hey</x-card>
    </div>
@endsection
