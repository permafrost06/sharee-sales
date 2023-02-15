@extends('admin.layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Ledger</h3>
                    </div>
                    @if (count($customerDeposits) > 0)
                        <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                                <span>Customer Id: {{ $customerDeposits[0]->customer_id }}</span><br>
                                <span>Customer Name: {{ $customerDeposits[0]->name }}</span>

                            </div>
                            <div class="col-md-4">
                                <span>Customer Limit: {{ $customerDeposits[0]->limit }}</span>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <span>Total LV: {{ $lv }}</span><br>
                            </div>
                            <div class="col-md-3">
                                <span>Total Received Money: {{ $receivedMoney }}</span>

                            </div>
                            <div class="col-md-3">
                                <span>Total Due Balance: {{ $totalDue }}</span>

                            </div>

                        </div>
                        <div class="row col-md-offset-1">
                            <span>Total Goods of Issues: {{ $goodsOfIssues }}</span>
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
                                    <th>Goods of Issues</th>
                                    <th>LV</th>
                                    <th>Received money</th>
                                    <th>Balance(Due)</th>
                                    <th>Remark</th>
                                    <th>
                                        <a type="button" class=" btn btn-xs btn-danger" onclick="deleteMultiple()">
                                            <i class="fa fa-trash"></i> Delete selected
                                        </a>
                                    </th>
                                    <th class="text-center"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($customerDeposits))
                                    @foreach ($customerDeposits as $k => $customerDeposit)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            <td>
                                                <a href="#">{{ $customerDeposit->date }}</a>
                                            </td>
                                            <td>{{ $customerDeposit->memo_number }}</td>
                                            <td> {{ $customerDeposit->goods_of_issues }}</td>
                                            <td> {{ $customerDeposit->lv }}</td>
                                            <td> {{ $customerDeposit->received_money }}</td>
                                            <td>
                                                {{ $customerDeposit->goods_of_issues - $customerDeposit->received_money }}
                                            </td>
                                            <td> {{ $customerDeposit->comment }}</td>
                                            <td>
                                                <input type="checkbox" onclick="checkedItem({{ $customerDeposit->id }})">
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('sales.edit', ['id' => $customerDeposit->id]) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-xs btn-danger"
                                                    href="{{ route('sales.delete', ['id' => $customerDeposit->id]) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>

                    @if (count($customerDeposits) > 0)
                        <a href="{{ route('sales.generatePDF', ['id' => $customerDeposits[0]->customer_id]) }}">
                            Download pdf
                        </a>
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
                    url: '{{ route('sales.delete.multiple') }}',
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
