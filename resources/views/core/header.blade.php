<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href={{route('home')}} class="nav-link">{{__('Home')}}</a>
        </li>
    </ul>


</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href={{route('home')}} class="brand-link" >
        <img src="{{asset('img/logo.jpeg')}}" alt="STi Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light" style="padding-left: 90px"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
            <div class="image">
                <a href=#  class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                         alt="User Image">
                </a>
                <div class="dropdown-menu" style="position: fixed" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('changePass')}}" style="color: black">Change password</a>
                    <a class="dropdown-item" href="{{route('logOut')}}" style="color: black">LogOut</a>
                </div>
            </div>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class="d-block">Hello: {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                </div>
            </div>  

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('work.index')}} class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Work</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{route('staff.index')}} class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Staff</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>

        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>

