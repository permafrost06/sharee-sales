@extends('layouts.admin')
@section('page')
    <div class="mb-6 text-gray-600">
        <x-breadcrumb :home="[
            'route' => 'admin.index',
            'label' => 'Home',
        ]" :items="[
            [
                'link' => route('vendor.index'),
                'label' => 'Vendors',
            ],
        ]" :active="$vendor ? 'Update' : 'Insert'" />
    </div>
    <x-cards.card class="max-w-4xl">
        <div class="flex items-center py-2 border-b px-6">
            <h3 class="flex-grow text-dark">{{ $vendor ? 'Update Vendor' : 'Insert Vendor' }}</h3>
            <a href="{{ route('vendor.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                View All
            </a>
        </div>
        <form action="{{ route('vendor.form', ['id' => $vendor?->id ?? 'add']) }}" method="POST" class="p-6"
            enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">


                <x-form.input type="text" label="ID" name="id" value="{{ old('id', $vendor?->id) }}"
                    placeholder="Vendor ID" />

                <x-form.input type="text" label="Name" name="name" value="{{ old('name', $vendor?->name) }}"
                    placeholder="Vendor name" />

                <x-form.input type="text" label="Address" name="address" value="{{ old('address', $vendor?->address) }}"
                    placeholder="Vendor address" />

                <x-form.input type="number" min="0" label="Limit" name="limit"
                    value="{{ old('limit', $vendor?->limit) }}" />

            </div>
            <x-button type="submit" class="my-4">
                {{ $vendor ? 'Update' : 'Add' }}
            </x-button>
        </form>
    </x-cards.card>
@endsection