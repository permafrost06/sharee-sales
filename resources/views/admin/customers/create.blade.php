@extends('layouts.admin')
@section('page')
    <div class="mb-6 text-gray-600">
        <x-breadcrumb :home="[
            'route' => 'admin.index',
            'label' => 'Home',
        ]" :items="[
            [
                'link' => route('customers.index'),
                'label' => 'Customers',
            ],
        ]" active="Add" />
    </div>
    <x-cards.card class="max-w-4xl">
        <div class="flex items-center py-2 border-b px-6">
            <h3 class="flex-grow text-dark">Add New Customer</h3>
            <a href="{{ route('customers.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                View All
            </a>
        </div>
        <form action="{{ route('customers.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">

                <x-form.input label="ID" name="customers_id" />

                <x-form.input label="Name" name="name" />

                <x-form.input label="Address" name="address" />

                <x-form.input label="Limit" name="limit" type="number" min="0" />

                <x-form.select label="Select Type" name="type">
                    <option value="1">Bongo Bajar</option>
                    <option value="2">Anexco</option>
                    <option value="3">Others</option>
                </x-form.select>
            </div>
            <x-button type="submit" class="my-4">
                Create
            </x-button>
        </form>
    </x-cards.card>
@endsection
