@extends('user.master.master')
@section('title', 'Danh sách công việc đã ẩn')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách công việc đã ẩn</h3>
                    </div>
                    <div class="card-body" id="car-body">
                      
                        <table id="worktable" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Công việc</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                        @if($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-time">{{ $value->detail }}</td>
                                            <td class="check-time time">{{ $value->start_date }}</td>
                                            <td class="check-time time">{{ $value->end_date }}</td>
                                            <td class="check-time time">{{ $value->status }}</td>
                                        @elseif ($date->diffInDays($value->end_date,false) < 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-timeOut">{{ $value->detail }}</td>
                                            <td class="check-timeOut time">{{ $value->start_date }}</td>
                                            <td class="check-timeOut time">{{ $value->end_date }}</td>
                                            <td class="check-timeOut time">{{ $value->status }}</td>
                                        @else
                                            <td>{{ $value->detail }}</td>
                                            <td class="time">{{ $value->start_date }}</td>
                                            <td class="time">{{ $value->end_date }}</td>
                                            <td class="time">{{ $value->status }}</td>
                                        @endif
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

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>


@endsection
