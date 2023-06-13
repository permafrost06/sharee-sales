@extends('admin.layouts.layout')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Stock Logs</h3>
                    <div class="pull-right box-tools">
                        <a href="{{ route('stocks.status') }}" class="btn btn-success btn-flat btn-sm" style="margin-right: 6px">
                            <i class="fa fa-mail-reply"></i> Back
                        </a>
                        <a href="{{ route('stocks.form', ['stock' => 'add']) }}" class="btn btn-primary btn-flat pull-right btn-sm">
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
                <div class="box-body">
                    <table id="logs-tbl" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sln</th>
                                <th>Item Code</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Adjustment</th>
                                <th>Total Cost</th>
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
                            <tr>
                                <td colspan="17">
                                    <div class="text-center p-10">Loading...</div>
                                </td>
                            </tr>
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
    function viewAttachment(){
        $('#modal-attachment h4').html('Attachment of <b><i>' + $(this).data('title') + '</i></b>');
        const src = $(this).data('src');
        if (src && src.endsWith('.pdf')) {
            $('#modal-attachment #att-preview').html(`<iframe src="${src}"></iframe>`);
        } else {
            $('#modal-attachment #att-preview').html(`<img src="${src}" alt=""/>`);
        }
    }
    const columns = [
        {name: 'id'},
        {name: 'item_code'},
        {name: 'brand'},
        {name: 'quantity'},
        {name: 'unit_cost'},
        {name: 'adjustment'},
        {name: 'total_cost'},
        {name: 'type'},
        {name: 'merchant_name'},
        {name: 'merchant_contact'},
        {name: 'carrier_name'},
        {name: 'carrier_contact'},
        {name: 'border'},
        {name: 'remarks', sortable: false, searchable: false},
        {name: 'attachment', sortable: false, searchable: false},
        {name: 'date_time'},
        {name: 'action', sortable: false, searchable: false},
    ];
    $('#logs-tbl').DataTable({
        serverSide: true,
        processing: true,
        language: {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        ajax: {
            url: "{{route('stocks.logs_api', ['item' => $item])}}",
            dataSrc: data => {

                $('#logs-tbl').removeAttr('style').parent().css({'overflow-x': 'auto'});
                const formatDate = getDateFormater();
                if(data.data){
                    const items = [];
                    data.data.forEach((row, idx) => {
                        const item = [];
                        columns.forEach(c=>{
                            let val = row[c.name];
                            switch(c.name){
                                case 'id':
                                    val = data.start + idx + 1;
                                    break;
                                case 'type':
                                    val = `<div class="text-center"><p class="btn btn-xs btn-warning text-uppercase">${val}</p></div>`;
                                    break;
                                case 'attachment':
                                    if(val){
                                        val = `<a href="#modal-attachment" onclick="viewAttachment.call(this)" data-toggle="modal" data-target="#modal-attachment" data-title="${row.item_code}" data-src="{{asset('')}}/${val}">View</a>`;
                                    }
                                    break;
                                case 'date_time':
                                    val = formatDate(val);
                                    break;
                            }
                            item.push(val || 'N/A')
                        });
                        item[item.length - 1] = getAction(row);
                        items.push(item);
                    });
                    data.data = items;
                    return items;
                }
                return [];
            }
        },
        columns,
        order: [[0, 'desc']]
    });

    function getAction(stock){
        const action = '{{ route("stocks.form", ["stock" => ":id"]) }}'.replace(':id', stock.id);
        return `
        <a href="${action}" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i> Edit
        </a>
        <form style="display: inline-block" action="${action}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-xs btn-danger">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
        `;
    }

    
</script>
@endsection