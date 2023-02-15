@extends('admin.layouts.layout')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer Create</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('customers.index') }}"
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
                    <form class="form-horizontal" action="{{ route('sales.update') }}" method="post"
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
                                            <label for="" class="col-sm-2 control-label">Customer</label>

                                            <div class="col-sm-10">
                                                <select class="form-control" name="customer_id">
                                                    @foreach ($customers as $customer)
                                                        <option @if ($sale->customer_id == $customer->id) selected @endif
                                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Date</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="date" value="{{ $sale->date }}"
                                                    class="form-control" id="datepicker" placeholder="date">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Memo Number</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="memo_number" value="{{ $sale->memo_number }}"
                                                    class="form-control" id="name" placeholder="memo number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">G O Issues</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" value="{{ $sale->goods_of_issues }}"
                                                    step="0.01" name="goods_of_issues" class="form-control"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">LV</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" value="{{ $sale->lv }}"
                                                    step="0.01" name="lv" class="form-control" id="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Received Money</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" value="{{ $sale->received_money }}"
                                                    step="0.01" name="received_money" class="form-control"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Balance (DUE)</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" value="{{ $sale->balance_due }}"
                                                    step="0.01" name="balance_due" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Comment</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="comment">{{ $sale->comment }}</textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $sale->id }}">

                                    </div>
                                    <!-- /.box-body -->

                                    <!-- /.box-footer -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Update</button>
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
