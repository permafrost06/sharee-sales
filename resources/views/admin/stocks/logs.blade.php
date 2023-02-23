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
                                <i class="fa fa-plus"></i> Add Stock Entry
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
                                    <th>Merchant Name</th>
                                    <th>Merchant Contact</th>
                                    <th>Carrier Name</th>
                                    <th>Carrier Contact</th>
                                    <th>Border</th>
                                    <th>Remarks</th>
                                    <th>Attachment</th>
                                    <th>Date & Time</th>
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
                                        <td>{{ $log->merchant_name??'N/A' }}</td>
                                        <td>{{ $log->merchant_contact??'N/A' }}</td>
                                        <td>{{ $log->carrier_name??'N/A' }}</td>
                                        <td>{{ $log->carrier_contact??'N/A' }}</td>
                                        <td>{{ $log->border??'N/A' }}</td>
                                        <td>{{$log->remarks??'N/A'}}</td>
                                        <td>
                                            @if($log->attachment)
                                                <a href="#modal-attachment"
                                                    data-toggle="modal"
                                                    data-target="#modal-attachment"
                                                    data-title="{{$log->item_code}}"
                                                    data-src="{{asset($log->attachment)}}"
                                                    class="show-attachment-modal">View</a>
                                            @else
                                                N/A
                                            @endif
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
                                        <td colspan="14">
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
    <div class="modal fade" id="modal-attachment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Purchase</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body" id="att-preview"></div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('extra-script')
<script>
    $('.show-attachment-modal').click(function(){
        $('#modal-attachment h4').html('Attachment of <b><i>' + $(this).data('title')+'</i></b>');
        const src = $(this).data('src');
        if(src && src.endsWith('.pdf')){
            $('#modal-attachment #att-preview').html(`<iframe src="${src}" style="max-height: 100%; width: 100%; height: 70vh;"></iframe>`);
        }else{
            $('#modal-attachment #att-preview').html(`<img src="${src}" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt=""/>`);
        }
    });
</script>
@endsection
