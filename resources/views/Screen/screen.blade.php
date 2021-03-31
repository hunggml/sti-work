@extends('master.master')
@section('title', 'Danh sách công việc')
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
                                    {{-- <input type="datetime-Local" style="font-size: 25px;border:0" disabled
                                        value={{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }} > --}}
                                    <span id="time" style="font-size: 30px;border:0;color:black"  disabled></span>
                                    <h1>Sáng tạo - Triệt để - Cam kết</h1>
                                    <span style="float: right">
                                        {{ $user->links() }}
                                    </span>
                                </div>
                                <div class="card-body" id="car-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tên nhân viên</th>
                                                <th>Công việc</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $key => $value0)
                                                @foreach ($value0->work as $key1 => $value)
                                                    @if ($value->detail == null)
                                                    <tr >
                                                        <td rowspan="{{ $value0->work->count() }}">
                                                            {{ $value->user_name }}</td>
                                                        <td style="background-color: #f13149" id="detail">{{ $value->detail }}</td>
                                                        <td>{{ $value->start_date }}</td>
                                                        <td>{{ $value->end_date }}</td>
                                                    </tr>
                                                    @else
                                                    @if ($key1 == 0)
                                                        <tr>
                                                            <td rowspan="{{ $value0->work->count() }}">
                                                                {{ $value->user_name }}</td>
                                                            <td>{{ $value->detail }}</td>
                                                            <td>{{ $value->start_date }}</td>
                                                            <td>{{ $value->end_date }}</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{ $value->detail }}</td>
                                                            <td>{{ $value->start_date }}</td>
                                                            <td>{{ $value->end_date }}</td>
                                                        </tr>
                                                    @endif
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
    <script>
        function time(){
            let time = new Date();
            let day = time.getDay();
            let month = time.getMonth();
            let years = time.getFullYear();
            let hour = time.getHours();
            let minute = time.getMinutes();
            let sescord = time.getSeconds();
            if(hour < 10){
                hour = "0" + hour;
            }
            if(minute < 10){
                minute = "0" + minute;
            }
            if(sescord < 10){
                sescord = "0" + sescord;
            }
            document.getElementById('time').innerHTML = day + "/" + month + "/" + years + "-" + hour + ":" + minute + ":" + sescord;
            setTimeout("time()",1000);
        }
        time();
    </script>
@endsection
