@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vendors</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('vendor.create') }}"
                                class="btn btn-block btn-primary btn-flat pull-right btn-sm">
                                <i class="fa fa-plus"></i> Add Vendor
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @if (Session::has('message'))
                        <div class="col-md-6 col-md-offset-2"id="successMessage">
                            <span> {{ Session::get('message') }}</span>
                        </div>
                    @endif
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sln</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Balance(Due)</th>
                                    <th>View Ledger</th>
                                    <th class="text-center">Signal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($vendors))
                                    @foreach ($vendors as $k => $vendor)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('sales.index', ['id' => $vendor->id]) }}">{{ $vendor->name }}</a>
                                            </td>
                                            <td>{{ $vendor->address }}</td>
                                            <td> {{ ucfirst($vendor->due) }}</td>
                                            <td>
                                                <a class="btn btn-xs btn-warning"
                                                    href="{{ route('purchase.index', ['id' => $vendor->id]) }}">Ledger</a>
                                            </td>
                                            <td class="text-center">
                                                @if ($vendor->limit >= $vendor->due)
                                                    <a class="btn btn-sm btn-success"></a>
                                                @else
                                                    <a class="btn btn-sm btn-danger"></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('vendor.edit', ['id' => $vendor->id]) }}"
                                                    class="btn btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('vendor.delete', ['id' => $vendor->id]) }}"
                                                    class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
