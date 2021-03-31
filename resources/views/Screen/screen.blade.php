@extends('master.master')
@section('title', 'All-Work')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <input type="datetime-Local" style="font-size: 25px;border:0" disabled
                                        value={{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}>
                                    <h1 style="text-align: center; display:inline-block; margin-left:150px">Sáng tạo - Triệt
                                        để - Cam kết</h1>
                                    <span style="float: right">
                                        {{ $user->links() }}
                                    </span>
                                </div>
                                <div class="card-body" id="car-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Staff-Name</th>
                                                <th>Work detail</th>
                                                <th>Start-Date</th>
                                                <th>End-Date</th>
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $key => $value0)
                                                @foreach ($value0->work as $key1 => $value)
                                                
                                                    @if ($key1 == 0)
                                                        <tr>
                                                            <td id="username" rowspan="{{ $value0->work->count() }}">
                                                                {{ $value->user_name }}</td>
                                                            <td id="detail">{{ $value->detail }}</td>
                                                            <td id="start_date">{{ $value->start_date }}</td>
                                                            <td id="end_date">{{ $value->end_date }}</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{ $value->detail }}</td>
                                                            <td>{{ $value->start_date }}</td>
                                                            <td>{{ $value->end_date }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
