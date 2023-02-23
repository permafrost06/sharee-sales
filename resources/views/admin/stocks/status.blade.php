@extends('admin.layouts.layout')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
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
            <div class="col-md-6 text-success" id="successMessage">
                <span> {{ Session::get('message') }}</span>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Stock Status</h3>
                    <div class="pull-right box-tools">
                        <a href="{{ route('stocks.form', ['stock' => 'add']) }}" class="btn btn-block btn-primary btn-flat pull-right btn-sm">
                            <i class="fa fa-plus"></i> Add Stock Entry
                        </a>
                    </div>
                </div>
                <div class="box-footer">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sln</th>
                                <th>Item Code</th>
                                <th>Quantity</th>
                                <th>Attachments</th>
                                <th>Remarks</th>
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
                                <td>
                                    @if($stock->item?->attachment)
                                    <a href="#" data-toggle="modal" data-target="#modal-attachment" data-item="{{$stock->item_code}}" data-src="{{asset($stock->item?->attachment)}}" class="show-attachment-modal">View</a>
                                    |
                                    @endif
                                    <a href="#" data-toggle="modal" data-target="#modal-attachment-form" data-item="{{$stock->item_code}}" class="show-attachment-modal-form">Edit</a>
                                </td>
                                <td>
                                    <p class="text-muted">{{$stock->item?->remarks}}</p>
                                    <a href="#" data-toggle="modal" data-target="#modal-remarks" data-item="{{$stock->item_code}}" class="show-remarks-modal">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
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
            @csrf
            <input type="hidden" name="item_code">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Attachment for <b>Some Item</b></h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div id="att-preview" style="margin-bottom: 10px"></div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-attachment-form">
    <div class="modal-dialog">
        <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{route('stocks.update')}}">
            @csrf
            <input type="hidden" name="item_code">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Attachment for <b>Some Item</b></h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="attachment" class="col-sm-2 control-label">Upload</label>
                        <div class="col-sm-10">
                            <input type="file" name="attachment" value="{{ old('attachment', $stock?->attachment) }}" class="form-control" id="attachment">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">
                        Save
                    </button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-remarks">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{route('stocks.update')}}">
            @csrf
            <input type="hidden" name="item_code">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remarks for <b>Some Item</b></h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea name="remarks" class="form-control" id="remarks" style="resize:none" rows="6">{{ old('remarks') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">
                        Save
                    </button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('extra-script')
<script>
    $('.show-attachment-modal').click(function() {
        const src = $(this).data('src');
        $('#modal-attachment h4').html('Attachment of <b><i>' + $(this).data('item') + '</i></b>');
        if (src && src.endsWith('.pdf')) {
            $('#modal-attachment #att-preview').html(`<iframe src="${src}"></iframe>`);
        } else {
            $('#modal-attachment #att-preview').html(`<img src="${src}" alt=""/>`);
        }
    });

    $('.show-attachment-modal-form').click(function() {
        $('#modal-attachment-form h4').html('Update attachment of <b><i>' + $(this).data('item') + '</i></b>');
        $('#modal-attachment-form input[name="item_code"]').val($(this).data('item'));
    });

    $('.show-remarks-modal').click(function() {
        $('#modal-remarks textarea').html($(this).prev().html());
        $('#modal-remarks h4').html('Remarks of <b><i>' + $(this).data('item') + '</i></b>');
        $('#modal-remarks input[name="item_code"]').val($(this).data('item'));
    });
</script>
@endsection