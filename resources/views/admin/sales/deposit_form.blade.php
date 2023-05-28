@extends('layouts.admin')
@section('page')
    <div class="mb-6 text-gray-600">
        <x-breadcrumb :home="[
            'route' => 'admin.index',
            'label' => 'Home',
        ]" :items="[
            [
                'link' => route('sales.index'),
                'label' => 'Sales',
            ],
        ]" active="Deposit" />
    </div>
    <x-cards.card>
        <h3 class="px-3 py-4 border-b text-dark">Add New Deposit</h3>
        <form action="{{ route('sales.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 lg:grid-cols-2 2xl:grid-cols-3">
                <x-form.select label="Customer" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </x-form.select>

                <x-form.input type="date" label="Date" name="date" />
                <x-form.input label="Memo Number" name="memo_number" />
                <x-form.input label="G O Issues" name="goods_of_issues" type="number" />
                <x-form.input label="LV" name="lv" type="number" />
                <x-form.input label="Quantity" name="quantity" />

                <x-form.input label="Received Money" name="received_money" />
                <x-form.input label="Balance (DUE)" name="balance_due" type="number" min="0" step="0.01" />
                <x-form.textarea label="Comment" name="comment"></x-form.textarea>
            </div>
            <x-button type="submit" class="my-4">
                Create
            </x-button>
        </form>
    </x-cards.card>
@endsection
