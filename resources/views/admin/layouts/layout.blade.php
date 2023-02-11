<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('extra-meta')
    <title>{{ config('app.name', 'App') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" integrity="sha512-UDJtJXfzfsiPPgnI5S1000FPLBHMhvzAMX15I+qG2E2OAzC9P1JzUwJOfnypXiOH7MRPaqzhPbBGDNNj7zBfoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" integrity="sha512-qWVvreMuH9i0DrugcOtifxdtZVBBL0X75r9YweXsdCHtXUidlctw7NXg5KVP3ITPtqZ2S575A0wFkvgS2anqSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    @include('admin.layouts.includes.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin.layouts.includes.navigation')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- All Dynamic Content Placed Here -->
        @section('content') @show
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Deposit</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('sales.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                @if ($errors->any())
                                    <div class="col-md-6 col-md-offset-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <span>{{ $error }}</span>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-md-12">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Customer</label>

                                            <div class="col-sm-10">
                                                <select class="form-control" name="customer_id">
                                                    @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Date</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="date" class="form-control" id="datepicker" placeholder="date">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Memo Number</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="memo_number" class="form-control" id="name" placeholder="memo number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">G O Issues</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0"  step="0.01" name="goods_of_issues" class="form-control" id="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">LV</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" step="0.01" name="lv" class="form-control" id="" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Received Money</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" step="0.01" name="received_money" class="form-control" id="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Balance (DUE)</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" step="0.01" name="balance_due" class="form-control" id="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Comment</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="comment"></textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.box-body -->

                                    <!-- /.box-footer -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
	<div class="modal fade" id="modal-purchase">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Purchase</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('purchase.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                @if ($errors->any())
                                    <div class="col-md-6 col-md-offset-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <span>{{ $error }}</span>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-md-12">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Vendor</label>

                                            <div class="col-sm-10">
                                                <select class="form-control" name="vendor_id">
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Date</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="date" class="form-control" id="datepicker2" placeholder="date">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Memo Number</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="memo_number" class="form-control" id="name" placeholder="memo number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Quantity</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="quantity" class="form-control" id="name" placeholder="quantity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Mark</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="mark" class="form-control" id="name" placeholder="mark">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Ball</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="ball" class="form-control" id="name" placeholder="ball">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">G O Issues</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0"  step="0.01" name="goods_of_issues" class="form-control" id="" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Paid Money</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" step="0.01" name="paid_money" class="form-control" id="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Balance (DUE)</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" step="0.01" name="balance_due" class="form-control" id="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Comment</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="comment"></textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.box-body -->

                                    <!-- /.box-footer -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                </div>--}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs"></div>
        <!-- Default to the left -->
        <strong><a href="#"></a></strong>
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('assets/admin')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/admin')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{asset('assets/admin')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="{{asset('assets/admin')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/admin')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin')}}/dist/js/adminlte.min.js"></script>
@yield('extra-script')
<script>
    $(function () {
        $('#example2').DataTable()
    });

    $("#successMessage").show().delay(2000).queue(function(n) {
        $(this).hide(); n();
    });
    $('#datepicker').datepicker({
        autoclose: true
    })

</script>

</body>
</html>
