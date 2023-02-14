@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stock Status</h3>
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
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stocks as $k=>$stock)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>
                                            <a href="{{route('stocks.logs', ['item' => $stock->item_code])}}">{{ $stock->item_code }}</a>
                                        </td>
                                        <td> {{ $stock->total_quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
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