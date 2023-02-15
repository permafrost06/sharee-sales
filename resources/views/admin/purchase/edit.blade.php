@extends('admin.layouts.layout')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer Create</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('vendor.index') }}"
                                class="btn btn-block btn-primary btn-flat pull-right btn-sm">
                                <i class="fa fa-mail-forward"></i> View All
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div class="col-md-6 col-md-offset-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="col-md-6 col-md-offset-2">
                            <span> {{ Session::get('message') }}</span>
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{ route('purchase.update') }}" method="post"
                        enctype="multipart/form-data">
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
                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Date</label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $purchase->date }}" name="date"
                                                    class="form-control" id="datepicker2" placeholder="date">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Memo Number</label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $purchase->memo_number }}"
                                                    name="memo_number" class="form-control" id="name"
                                                    placeholder="memo number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Quantity</label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $purchase->quantity }}" name="quantity"
                                                    class="form-control" id="name" placeholder="quantity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Mark</label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $purchase->mark }}" name="mark"
                                                    class="form-control" id="name" placeholder="mark">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Ball</label>

                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $purchase->ball }}" name="ball"
                                                    class="form-control" id="name" placeholder="ball">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">G O Issues</label>

                                            <div class="col-sm-10">
                                                <input type="number" value="{{ $purchase->goods_of_issues }}"
                                                    min="0" step="0.01" name="goods_of_issues"
                                                    class="form-control" id="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Paid Money</label>

                                            <div class="col-sm-10">
                                                <input type="number" value="{{ $purchase->paid_money }}" min="0"
                                                    step="0.01" name="paid_money" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Balance (DUE)</label>

                                            <div class="col-sm-10">
                                                <input type="number" value="{{ $purchase->balance_due }}"
                                                    min="0" step="0.01" name="balance_due"
                                                    class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Comment</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="comment">{{ $purchase->comment }}</textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $purchase->id }}">

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
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
