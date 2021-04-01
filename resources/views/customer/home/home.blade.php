@extends('customer.master.master')
@section('titleCustomer', 'Trang chủ')
@section('contain')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <span id="time" style="font-size: 30px;border:0;color:black" disabled></span>
                        <h1>Sáng tạo - Triệt để - Cam kết</h1>
                        {{-- <span style="float: right">
                                    {{ $user->links() }}
                                </span> --}}
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
                                            <tr>
                                                <td rowspan="{{ $value0->work->count() }}">
                                                    {{ $value->user_name }}
                                                </td>
                                                <td style="background-color: #f13149">{{ $value->detail }}</td>
                                                <td>{{ $value->start_date }}</td>
                                                <td>{{ $value->end_date }}</td>
                                            </tr>
                                        @elseif (Carbon\Carbon::now()->diffInMinutes($value->end_date,false) <= 0) @if ($key1 == 0) <tr>
                                                <td rowspan="{{ $value0->work->count() }}">
                                                    {{ $value->user_name }}</td>
                                                <td class="check-time">{{ $value->detail }}</td>
                                                <td class="check-time">{{ $value->start_date }}</td>
                                                <td class="check-time">{{ $value->end_date }}</td>
                                            </tr>
                                    @else
                                            <tr>
                                                <td class="check-time">{{ $value->detail }}</td>
                                                <td class="check-time">{{ $value->start_date }}</td>
                                                <td class="check-time">{{ $value->end_date }}</td>
                                            </tr> @endif @else @if ($key1 == 0)
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
        function time() {
            let time = new Date();
            let day = time.getDate();
            let month = time.getMonth() + 1;
            let years = time.getFullYear();
            let hour = time.getHours();
            let minute = time.getMinutes();
            let sescord = time.getSeconds();
            if (hour < 10) {
                hour = "0" + hour;
            }
            if (minute < 10) {
                minute = "0" + minute;
            }
            if (sescord < 10) {
                sescord = "0" + sescord;
            }
            document.getElementById('time').innerHTML = day + "/" + month + "/" + years + "-" + hour + ":" + minute + ":" +
                sescord;
            setTimeout("time()", 1000);
        }
        time();

    </script>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
@endsection
