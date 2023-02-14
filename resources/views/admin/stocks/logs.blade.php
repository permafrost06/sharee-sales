@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stock Logs</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('stocks.status') }}"
                                class="btn btn-success btn-flat btn-sm" style="margin-right: 6px">
                                <i class="fa fa-mail-reply"></i> Back
                            </a>
                            <a href="{{ route('stocks.form', ['stock' => 'add']) }}"
                                class="btn btn-primary btn-flat pull-right btn-sm">
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
                    <div class="box-footer" style="overflow-x: auto">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sln</th>
                                    <th>Item Code</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Type</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Contact</th>
                                    <th>Carrier Name</th>
                                    <th>Carrier Contact</th>
                                    <th>Border</th>
                                    <th>Remarks</th>
                                    <th>Date time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $k=>$log)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>
                                            {{ $log->item_code }}
                                        </td>
                                        <td>{{ $log->brand }}</td>
                                        <td> {{ $log->quantity }}</td>
                                        <td class="text-center">
                                            <p class="btn btn-xs btn-warning text-uppercase">{{ $log->type }}</p>
                                        </td>
                                        <td>{{ $log->supplier_name }}</td>
                                        <td>{{ $log->supplier_contact }}</td>
                                        <td>{{ $log->carrier_name }}</td>
                                        <td>{{ $log->carrier_contact }}</td>
                                        <td>{{ $log->border }}</td>
                                        <td>
                                            <a href="{{asset($log->remarks)}}">View</a>
                                        </td>
                                        <td>{{ date('h:i A | d M, Y', strtotime($log->date_time)) }}</td>
                                        <td>
                                            <a href="{{ route('stocks.form', ['stock' => $log->id]) }}"
                                                class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form style="display: inline-block" action="{{ route('stocks.form', ['stock' => $log->id]) }}" method="POST">
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
