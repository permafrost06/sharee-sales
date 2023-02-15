@extends('admin.layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Home
            <small>Optional description</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="" class="small-box bg-aqua">
                    <div class="inner">
                        <h4>{{ $totalCustomers }}</h4>

                        <p>Total customers</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <p href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="" class="small-box bg-aqua">
                        <div class="inner">
                            <h4>{{ $customersDue }}</h4>

                            <p>Customers Due</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <p href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="" class="small-box bg-aqua">
                        <div class="inner">
                            <h4>{{ $vendorsDue }}</h4>

                            <p>Vendors Due</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <p href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="" class="small-box bg-aqua">
                        <div class="inner">
                            <h4>{{ $lv }}</h4>

                            <p>LV</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <p href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="" class="small-box bg-aqua">
                        <div class="inner">
                            <h4>{{ $deposits }}</h4>

                            <p>Total Deposits Today</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <p href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection