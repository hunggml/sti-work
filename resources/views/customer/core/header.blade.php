<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href={{ route('trangchu') }} class="nav-link">{{ __('Trang chủ') }}</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    </ul>


</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href={{ route('trangchu') }} class="brand-link">
        <img src="{{ asset('img/logo.jpeg') }}" alt="STi Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light" style="padding-left: 90px"></span>
    </a>

    <!-- Sidebar -->
   @if ($auth)

    @if ($auth->level == 1)
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="image">
                <a href=# class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </a>
                <div class="dropdown-menu" style="position: fixed" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile.index') }}" style="color: black">Hồ sơ</a>
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
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li>
                        <a href="{{ route('home') }}"
                            class="nav-link {{ request()->is('/') ? 'active font-weight-bolder' : '' }}">
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
                    <li>
                        <a href= {{ route('staff.list')}}
                            class="nav-link {{ request()->routeIs('staff*') ? 'active font-weight-bolder' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách nhân viên</p>
                        </a>
                    </li>
                    <li>
                        <a href=#
                            class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Công việc cần xác nhận</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @else 
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="image">
                <a href=# class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </a>
                <div class="dropdown-menu" style="position: fixed" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile.index') }}" style="color: black">Hồ sơ</a>
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
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li>
                        <a href="{{ route('home') }}"
                            class="nav-link {{ request()->is('/') ? 'active font-weight-bolder' : '' }}">
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

                </ul>
            </nav>
        </div>
    @endif
    @else
    <div>
        <a href="{{ route('loginShow') }}" class="single-icon"><i class="fa fa-user" aria-hidden="true"></i>Đăng
            nhập</a>
    </div>
    @endif

    <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
