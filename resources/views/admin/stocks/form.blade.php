@extends('layouts.admin')
@section('page')
    <div class="mb-6 text-gray-600">
        <x-breadcrumb :home="[
            'route' => 'admin.index',
            'label' => 'Home',
        ]" :items="[
            [
                'link' => route('stocks.status'),
                'label' => 'Stock',
            ],
        ]" :active="$stock?'Update': 'Insert'" />
    </div>
    <x-cards.card class="max-w-4xl">
        <div class="flex items-center py-2 border-b px-6">
            <h3 class="flex-grow text-dark">{{ $stock ? 'Update Stock' : 'Insert Stock' }}</h3>
            <a href="{{ route('stocks.status') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                View All
            </a>
        </div>
        <form action="{{ route('stocks.store', ['stock' => $stock?->id ?? 'add']) }}" method="POST" class="p-6"
            enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">

                <x-form.alert />

                <x-form.input type="datetime-local" step="60" label="Date & Time" name="date_time"
                    value="{{ old('date_time', date('Y-m-d H:i', $stock?->date_time ? strtotime($stock?->date_time) : time())) }}" />

                <div>
                    <x-form.input label="Item Code" name="item_code" autocomplete="off"
                        value="{{ old('item_code', $stock?->item_code) }}" list="items-list" />

                    <datalist id="items-list">
                        @foreach ($item_codes as $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div>
                    <x-form.input label="Brand" name="brand" list="brands-list" autocomplete="off"
                        value="{{ old('brand', $stock?->brand) }}" />
                    <datalist id="brands-list">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div>
                    <x-form.input label="Border" name="border" list="borders-list" autocomplete="off"
                        value="{{ old('border', $stock?->border) }}" />
                    <datalist id="borders-list">
                        @foreach ($borders as $border)
                            <option value="{{ $border }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <x-form.textarea label="Remarks" name="remarks">{{ old('remarks', $stock?->remarks) }}</x-form.textarea>
            </div>
            <x-button type="submit" class="my-4">
                {{ $stock ? 'Update' : 'Add' }}
            </x-button>
        </form>
    </x-cards.card>
@endsection
