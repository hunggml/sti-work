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
                                    <h3 class="card-title">Staff List</h3>
                                </div>
                                <div class="card-body"> 
                                   
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Name</th>
                                            <th>User Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $key => $value)
                                            <tr>
                                                <th scope="row">{{ $value->id }}</th>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td><a class="btn btn-success"
                                                       href={{route('staff.edit',['id'=>$value->id])}}><i
                                                            class="far fa-edit"></i></a>
                                                    {{-- <a href={{route('staff.destroy',['id'=>$value->id])}}
                                                        class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete?')"><i
                                                        class="far fa-trash-alt"></i></a> --}}
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
