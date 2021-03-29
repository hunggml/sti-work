@extends('master.master')
@section('title','All-Work')
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
                                    <h1 style="text-align: center">Work in the Company</h1>
                                </div>
                                <div class="card-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Staff-Name</th>
                                            <th>Work detail</th>
                                            <th>Start-Date</th>
                                            <th>End-Date</th>
                                            <th>Status</th>
                                            <th>Update status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allWork as $key => $value)
                                            <tr>
                                                <td>{{ $value->user_name }}</td>
                                                <td>{{ $value->detail }}</td>
                                                <td>{{ $value->start_date }}</td>
                                                <td>{{ $value->end_date }}</td>
                                                @if($value->status == 'Hoàn thành')
                                                    <td style="background-color: greenyellow;color:black ">{{ $value->status }}</td>
                                                @else
                                                    <td style="background-color: #ff4a52;color: black">{{ $value->status }}</td>
                                                @endif
                                                <td><a class="btn btn-success"
                                                    href={{route('screen.edit',['id'=>$value->id])}}>
                                                    <i class="far fa-edit"></i>
                                                 </a>
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
