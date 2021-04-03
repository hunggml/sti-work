@extends('user.master.master')
@section('title', 'Thống kê')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách thống kê</h3>
                    </div>
                    <div class="card-body" id="car-body">

                        <table id="statiscal" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Công việc</th>
                                    <th>Thời gian cập nhật</th>
                                    <th>Thời gian kết thúc công việc</th>
                                    <th>Tiến độ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                @foreach ($user->work as $key1 => $value)
                               
                                <tr>
                                    @if ($key1 == 0)
                                        <td rowspan="{{ $user->work->count() }}">
                                            {{ $user->name }}
                                        </td>
                                    @endif
                                    <td>{{$value->detail}}</td>
                                    <td>{{$value->time_updated}}</td>
                                    <td>{{$value->end_date}}</td>
                                    @if ($date->diffInDays($value->end_date, false) < 0 && $value->status == 'Chưa hoàn thành')
                                        <td class="out-time">Quá hạn</td>
                                    @elseif($date->diffInDays($value->end_date, false) < 0 && $value->status == 'Hoàn thành')
                                        <td class="out-time">Quá hạn</td>
                                    @elseif($date->diffInDays($value->end_date, false) > 0 && $value->status == 'Hoàn thành')
                                        <td class="on-time">Đúng hạn</td>
                                    @elseif($date->diffInDays($value->end_date, false) > 0 && $value->status == 'Chưa hoàn thành')
                                        <td>Chưa đến hạn</td>
                                    @elseif($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Hoàn thành')
                                        <td class="on-time">Đúng hạn</td>
                                    @elseif($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Chưa hoàn thành')
                                        <td>Chưa đến hạn</td>
                                    @else
                                        <td>Chưa đến hạn</td>
                                    @endif
                                </tr>
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

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>


@endsection
