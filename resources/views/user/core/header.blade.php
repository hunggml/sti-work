<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <div class="row">
        <div class="col-md-4 mb-2">
            <a class="nav-link" data-widget="pushmenu" href="#" style="display: inline-block;padding:0" role="button"><i class="fas fa-bars"></i></a>
            <span id="time" class=" my-text" disabled></span>
        </div>
        <div class="col-md-5 mb-2">
            <div class="my-sologan">Sáng tạo - Triệt để - Cam kết</div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="row">
                <div class="meeting col-9">
                    @yield('metting')
                </div>
                <div class="col-3">
                    <div class="nav-item dropdown">
                        <a gtm-id="Notifications" class="nav-link " alt="Notifications"
                            id="navbarNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            
                            <i class="fas fa-bell" alt="Notifications" style="position: relative">
                                <span id="navbarNotificationCounter" class="badge rounded red z-depth-1" alt="Notifications"
                                style="color:red;font-size:15px;position: absolute;top:-10px;right:-10px;z-index:1"></span>
                            </i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" id="navbarNotificationContent"
                            aria-labelledby="navbarDropdownMenuLink">
                            <div id="notification-main"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        .sidebar{
            overflow: scroll;
        }
        .my-text {
            font-size: 20px;
            border: 0;
            color: black;
        }

        .my-sologan {
            font-size: 20px;
            border: 0;
            color: black;
            /* text-align: center */
        }

    </style>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href={{ route('home') }} class="brand-link ">
        <img src="{{ asset('img/logo.jpeg') }}" alt="STi Logo" class="brand-image img-circle elevation-3 "
            style="opacity: .8">
        <span class="brand-text font-weight-light " style="padding-left: 90px"></span>
    </a>

    <!-- Sidebar -->
    @auth
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="image">
                <a href=# class="btn btn-secondary dropdown-toggle " role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </a>
                <div class="dropdown-menu" style="position: fixed" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile.index') }}" style="color: black">Hồ sơ</a>
                    @if ($auth->metting == 0)
                        <a class="dropdown-item" href='{{ route('metting', ['metting' => 1, 'id' => $auth->id]) }}'
                            style="color: black">Đi công tác</a>
                        <a class="dropdown-item" href='{{ route('metting', ['metting' => 3, 'id' => $auth->id]) }}'
                            style="color: black">Xác nhận họp</a>
                    @endif
                    @if ($auth->metting == 1)
                    <a class="dropdown-item" href='{{ route('metting', ['metting' => 0, 'id' => $auth->id]) }}'
                        style="color: black">Xác nhận công tác về</a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logOut') }}" style="color: black">Đăng xuất</a>
                </div>
            </div>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block">Xin chào: {{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li>
                        <a href="{{ route('home') }}"
                            class="nav-link {{ request()->routeIs('home*') ? 'active font-weight-bolder' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách công việc</p>
                        </a>
                    </li>
                    <li>
                        <a href={{ route('work.index') }}
                            class="nav-link {{ request()->routeIs('work*') ? 'active font-weight-bolder' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Công việc cá nhân</p>
                        </a>
                    </li>
                    @if ($auth->level == 1)
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link {{ request()->routeIs('staff*','check*','group*','statistical*','chart*') ? 'active font-weight-bolder' : '' }}">
                                <i class="fas fa-tasks"></i>
                                <p>
                                    Quản lý
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ route('staff.stafflist') }}
                                        class="nav-link {{ request()->routeIs('staff*') ? 'active font-weight-bolder' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('check.list') }}
                                        class="nav-link {{ request()->routeIs('check*') ? 'active font-weight-bolder' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Xác nhận công việc</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('group.list') }}
                                        class="nav-link {{ request()->routeIs('group*') ? 'active font-weight-bolder' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Phòng ban</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('statistical.list') }}
                                        class="nav-link {{ request()->routeIs('statistical*') ? 'active font-weight-bolder' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách thống kê</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('chart') }}
                                        class="nav-link {{ request()->routeIs('chart*') ? 'active font-weight-bolder' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Biểu đồ thống kê</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    @else
        <div>
            <a href="{{ route('loginShow') }}" class="single-icon">
                <i class="fa fa-user" aria-hidden="true"></i>
                Đăng nhập
            </a>
        </div>
    @endauth

</aside>
