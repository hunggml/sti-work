@extends('user.master.master')
@section('title', 'Danh sách lịch sử chỉnh sửa')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách lịch sử chỉnh sửa công việc</h3>
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
                                        @if ($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-time">{{ $value->detail }}</td>
                                            <?php
                                            $start_date = strtotime($value->start_date);
                                            $end_date = strtotime($value->end_date);
                                            ?>
                                            <td class="check-time time">{{ date('d-m-Y', $start_date) }}</td>
                                            <td class="check-time time">{{ date('d-m-Y', $end_date) }}</td>
                                            <td class="check-time time">{{ $value->status }}</td>
                                        @elseif ($date->diffInDays($value->end_date,false) < 0 && $value->status ==
                                                'Chưa hoàn thành')
                                               <td class="check-timeOut">{{ $value->detail }}</td>
                                               <?php
                                               $start_date = strtotime($value->start_date);
                                               $end_date = strtotime($value->end_date);
                                               ?>
                                               <td class="check-timeOut time">{{ date('d-m-Y', $start_date) }}</td>
                                               <td class="check-timeOut time">{{ date('d-m-Y', $end_date) }}</td>
                                                <td class="check-timeOut time">{{ $value->status }}</td>
                                            @else
                                                <td>{{ $value->detail }}</td>
                                                <?php
                                                $start_date = strtotime($value->start_date);
                                                $end_date = strtotime($value->end_date);
                                                ?>
                                                <td class=" time">{{ date('d-m-Y', $start_date) }}</td>
                                                <td class=" time">{{ date('d-m-Y', $end_date) }}</td>
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