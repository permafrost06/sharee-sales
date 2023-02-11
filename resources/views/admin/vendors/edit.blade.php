@extends('admin.layouts.layout')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vendor update</h3>
                        <div class="pull-right box-tools">
                            <a href="
                                    {{ route('vendor.index') }}
                                "
                               class="btn btn-block btn-primary btn-flat pull-right btn-sm"><i class="fa fa-mail-forward"></i> View All</a>
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
                    @if(Session::has('message'))
                        <div class="col-md-6 col-md-offset-2">
                            <span> {{ Session::get('message') }}</span>
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{ route('vendor.update') }}" method="post" enctype="multipart/form-data">
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

                                <div class="col-md-6">

                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="customer-name" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="{{$vendor->name}}" class="form-control" id="name" placeholder="vendor name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="vendor-name" class="col-sm-2 control-label">Address</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="address">{{$vendor->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Limit</label>

                                            <div class="col-sm-10">
                                                <input type="number" min="0" name="limit" value="{{$vendor->limit}}" class="form-control" id="" >
                                            </div>
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="" class="col-sm-2 control-label">Select type</label>--}}

{{--                                            <div class="col-sm-10">--}}
{{--                                                <select class="form-control" name="type">--}}
{{--                                                    <option @if($vendor->type==1) selected @endif value="1">Bongo Bajar</option>--}}
{{--                                                    <option @if($vendor->type==2) selected @endif value="2">Anexco</option>--}}
{{--                                                    <option @if($vendor->type==3) selected @endif value="3">Others</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                    </div>
                                    <input type="hidden" name="id" value="{{ $vendor->id }}">
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        {{--                                                    <button type="submit" class="btn btn-default">Cancel</button>--}}
                                        <button type="submit" class="btn btn-info pull-right">Update</button>
                                    </div>
                                    <!-- /.box-footer -->

                                </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
