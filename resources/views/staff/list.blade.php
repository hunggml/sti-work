@extends('master.master')
@section('title','Staff List')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile</h3>
                                </div>
                                <div class="card-body"> 
                                   
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>User Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Edit profile</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $key => $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td><a class="btn btn-success"
                                                       href={{route('staff.edit',['id'=>$value->id])}}><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="{{route('changePass')}}"
                                                        class="btn btn-success" style="color: black">
                                                        <i class="fas fa-exchange-alt"></i>change pass
                                                    </a>
                                                        {{-- <a class="dropdown-item" href="{{route('changePass')}}" style="color: black">Change password</a> --}}

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    
@endsection
