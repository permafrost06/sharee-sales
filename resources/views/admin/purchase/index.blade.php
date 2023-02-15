@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Ledger</h3>
                    </div>
                    @if (count($purchases) > 0)
                        <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                                <span>Customer Id: {{ $purchases[0]->vendor_id }}</span><br>
                                <span>Customer Name: {{ $purchases[0]->name }}</span>

                            </div>
                            <div class="col-md-4">
                                <span>Customer Limit: {{ $purchases[0]->limit }}</span>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <span>Total Ball: {{ $ball }}</span><br>
                            </div>
                            <div class="col-md-3">
                                <span>Total Paid Money: {{ $paidMoney }}</span>


                            </div>
                            <div class="col-md-3">
                                <span>Total Due Balance: {{ $totalDue }}</span>

                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-3 col-md-offset-1">
                                <span>Total Goods of Issues: {{ $goodsOfIssues }}</span>
                            </div>
                            <div class="col-md-3">
                                <span>Total Quantity: {{ $totalQuantity }}</span>
                            </div>
                        </div>
                    @endif
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
                                    <th>Date</th>
                                    <th>Memo Number</th>
                                    <th>Quantity</th>
                                    <th>Goods of Issues</th>

                                    <th>Paid money</th>
                                    <th>Balance(Due)</th>
                                    <th>Remark</th>
                                    <th>
                                        <a type="button" class=" btn btn-xs btn-danger" onclick="deleteMultiple()">
                                            <i class="fa fa-trash"></i> Delete selected
                                        </a>
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($purchases))
                                    @foreach ($purchases as $k => $purchase)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            <td>
                                                <a href="#">{{ $purchase->date }}</a>
                                            </td>
                                            <td>{{ $purchase->memo_number }}</td>
                                            <td> {{ $purchase->quantity }}</td>
                                            <td> {{ $purchase->goods_of_issues }}</td>

                                            <td> {{ $purchase->paid_money }}</td>
                                            <td> {{ $purchase->goods_of_issues - $purchase->paid_money }}</td>
                                            <td> {{ $purchase->comment }}</td>
                                            <td><input type="checkbox" onclick="checkedItem({{ $purchase->id }})"></td>
                                            <td>
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('purchase.edit', ['id' => $purchase->id]) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-xs btn-danger"
                                                    href="{{ route('purchase.delete', ['id' => $purchase->id]) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>

                    @if (count($purchases) > 0)
                        <a href="{{ route('purchase.generatePDF', ['id' => $purchases[0]->vendor_id]) }}"> Download pdf</a>
                    @endif

                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
@section('extra-script')
    <script>
        var items = [];

        function checkedItem(id) {
            items.push(id);
            console.log(items)
        }

        function deleteMultiple() {
            if (confirm("Are you sure to delete these selected items?")) {
                $.ajax({
                    url: '{{ route('purchase.delete.multiple') }}',
                    type: 'get',
                    data: {
                        itemArray: items
                    },
                    success: function(response) {
                        console.log(response)
                        $("#example2").load(location.href + " #example2");
                    }
                });
            }
        }
    </script>
@endsection
