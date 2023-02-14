<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/admin/images/user.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form"> --}}
        {{-- <div class="input-group"> --}}
        {{-- <input type="text" name="q" class="form-control" placeholder="Search..."> --}}
        {{-- <span class="input-group-btn"> --}}
        {{-- <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> --}}
        {{-- </button> --}}
        {{-- </span> --}}
        {{-- </div> --}}
        {{-- </form> --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">HEADER</li> --}}
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    <span>Customers</span>
                    <span class="pull-right-container">
                        {{--          <span class="label label-primary pull-right">4</span> --}}
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('customers.create') }}"><i class="fa fa-plus"></i> <span>Add
                                Customer</span></a></li>
                    <li><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customer
                                list</span></a></li>
                </ul>
            </li>
            <li><a href="" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-life-bouy"></i> <span>New Deposit</span>
                </a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    <span>Vendors</span>
                    <span class="pull-right-container">
                        {{--          <span class="label label-primary pull-right">4</span> --}}</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('vendor.create') }}"><i class="fa fa-plus"></i> <span>Add Vendor</span></a>
                    </li>
                    <li><a href="{{ route('vendor.index') }}"><i class="fa fa-users"></i> <span>Vendor list</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="" data-toggle="modal" data-target="#modal-purchase">
                    <i class="fa fa-life-bouy"></i> <span>New Purchase</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i>
                    <span>Stock</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('stocks.form', ['stock' => 'add']) }}"><i class="fa fa-plus"></i> <span>Add Stock</span></a></li>
                    <li><a href="{{ route('stocks.status') }}"><i class="fa fa-info-circle"></i> <span>Stock Status</span></a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->

    <!-- /.modal -->
</aside>
