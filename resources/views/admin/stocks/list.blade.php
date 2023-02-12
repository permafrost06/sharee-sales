@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stocks</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('stocks.form', ['stock' => 'add']) }}"
                                class="btn btn-block btn-primary btn-flat pull-right btn-sm">
                                <i class="fa fa-plus"></i> Add Stock
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    @if (Session::has('message'))
                        <div class="col-md-6 col-md-offset-2 text-success" id="successMessage">
                            <span> {{ Session::get('message') }}</span>
                        </div>
                    @endif
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sln</th>
                                    <th>Item Code</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Type</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stocks as $k=>$stock)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>
                                            {{ $stock->item_code }}
                                        </td>
                                        <td>{{ $stock->brand }}</td>
                                        <td> {{ $stock->quantity }}</td>
                                        <td class="text-center">
                                            <p class="btn btn-xs btn-warning text-uppercase">{{ $stock->type }}</p>
                                        </td>
                                        <td>{{ $stock->supplier_name }}</td>
                                        {{-- <td>{{ date('y-m-d',strtotime($stock->created_at)) }}</td> --}}
                                        <td>
                                            <a href="{{ route('stocks.form', ['stock' => $stock->id]) }}"
                                                class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form style="display: inline-block" action="{{ route('stocks.form', ['stock' => $stock->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-danger">No stock is added!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
