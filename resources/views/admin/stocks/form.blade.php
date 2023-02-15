@extends('admin.layouts.layout')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $stock ? 'Update Stock' : 'Insert Stock' }}</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('stocks.status') }}"
                                class="btn btn-block btn-primary btn-flat pull-right btn-sm">
                                <i class="fa fa-mail-forward"></i> View All
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <form class="form-horizontal" action="{{ route('stocks.form', ['stock' => $stock?->id ?? 'add']) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                @if ($errors->any())
                                    <div class="col-md-6">
                                        <ul class="m-0 p-0 text-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('message'))
                                    <div class="col-md-6 text-success">
                                        <span> {{ Session::get('message') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="box-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Stock Type</label>
                                            <div class="col-sm-10">
                                                <label for="type1" class="radio-inline">
                                                    <input @checked(old('type', $stock?->type) == 'in') id="type1" type="radio"
                                                        name="type" value="in" />
                                                    In
                                                </label>
                                                <label for="type2" class="radio-inline">
                                                    <input @checked(old('type', $stock?->type) == 'out') id="type2" type="radio"
                                                        name="type" value="out" />
                                                    Out
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_time" class="col-sm-2 control-label">Date & Time</label>

                                            <div class="col-sm-10">
                                                <input
                                                    type="datetime-local"
                                                    step="60"
                                                    name="date_time"
                                                    value="{{ old('date_time', date('Y-m-d H:i', $stock?->date_time?strtotime($stock?->date_time):time())) }}" class="form-control"
                                                    id="date_time">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_code" class="col-sm-2 control-label">Item Code</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="item_code"
                                                    value="{{ old('item_code', $stock?->item_code) }}" class="form-control"
                                                    id="item_code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="brand" class="col-sm-2 control-label">Brand</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="brand"
                                                    value="{{ old('brand', $stock?->brand) }}" class="form-control"
                                                    id="brand">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity" class="col-sm-2 control-label">Quantity</label>

                                            <div class="col-sm-10">
                                                <input type="number" name="quantity"
                                                    value="{{ old('quantity', $stock?->quantity) }}" class="form-control"
                                                    id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier_name" class="col-sm-2 control-label">Supplier name</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="supplier_name"
                                                    value="{{ old('supplier_name', $stock?->supplier_name) }}"
                                                    class="form-control" id="supplier_name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="supplier_contact" class="col-sm-2 control-label">Supplier
                                                contact</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="supplier_contact"
                                                    value="{{ old('supplier_contact', $stock?->supplier_contact) }}"
                                                    class="form-control" id="supplier_contact">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="carrier_name" class="col-sm-2 control-label">Carrier name</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="carrier_name"
                                                    value="{{ old('carrier_name', $stock?->carrier_name) }}"
                                                    class="form-control" id="carrier_name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="carrier_contact" class="col-sm-2 control-label">Carrier
                                                contact</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="carrier_contact"
                                                    value="{{ old('carrier_contact', $stock?->carrier_contact) }}"
                                                    class="form-control" id="carrier_contact">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="border" class="col-sm-2 control-label">Border</label>

                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    name="border"
                                                    value="{{ old('border', $stock?->border) }}"
                                                    class="form-control"
                                                id="border">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attachment" class="col-sm-2 control-label">Attachment</label>

                                            <div class="col-sm-10">
                                                <input type="file" name="attachment"
                                                    value="{{ old('attachment', $stock?->attachment) }}" class="form-control"
                                                    id="attachment">
                                            </div>
                                            @if ($stock?->attachment)
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-10">
                                                    <a href="{{ asset($stock->attachment) }}">View Attachment</a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks" class="col-sm-2 control-label">Remarks</label>

                                            <div class="col-sm-10">
                                                <textarea name="remarks"
                                                    class="form-control"
                                                    id="remarks">{{ old('remarks', $stock?->remarks) }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">
                                            {{ $stock ? 'Update' : 'Add' }}
                                        </button>
                                    </div>
                                    <!-- /.box-footer -->

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
