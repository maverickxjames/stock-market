 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin Panel</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open" onclick="window.location.href='{{ route('admin.home') }}'">
                    <a href="" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Admin Manager
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('all-admin') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('admin_add_admin') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Manager
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('all-user') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('admin_add_user') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaction Manager
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('admin.deposit_txn') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link"
                                onclick="window.location.href='{{ route('admin.withdraw_txn') }}'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdraw Transaction</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bonus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penalty</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>History</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- for setting --}}
                <li class="nav-item" onclick="window.location.href='{{ route('admin.settings') }}'">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>

                <li class="nav-item" onclick="window.location.href='{{ route('dashboard') }}'">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>

                        <p>
                            Go to Website
                        </p>
                    </a>
                </li>
              

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>