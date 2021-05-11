@extends('user.master.master')
@section('title', 'Danh sách công việc nhân viên')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách công việc nhân viên</h3>
                    </div>
                    
                    <div class="card-body" id="car-body">
                        <a style="color: white;float:right" class="btn btn-secondary mb-2"
                            href={{ route('staff.stafflist') }}>
                            <i class="fas fa-arrow-circle-left"></i> Quay lại
                        </a>
                        <table id="worktable" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Công việc</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach ($work as $key => $value)
                                    @if ($value->detail == null)
                                        <tr hidden>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                        @if ($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-time">{{$value->detail}}</td>
                                                <?php
                                                $start_date = strtotime($value->start_date);
                                                $end_date = strtotime($value->end_date);
                                                ?>
                                            <td class="check-time time">{{ date('d-m-Y', $start_date) }}</td>
                                            <td class="check-time time">{{ date('d-m-Y', $end_date) }}</td>
                                        @elseif ($date->diffInDays($value->end_date,false) < 0 && $value->status =='Chưa hoàn thành')
                                            <td class="check-timeOut">{{$value->detail}}</td>
                                                <?php
                                                $start_date = strtotime($value->start_date);
                                                $end_date = strtotime($value->end_date);
                                                ?>
                                            <td class="check-timeOut time">{{ date('d-m-Y', $start_date) }}</td>
                                            <td class="check-timeOut time">{{ date('d-m-Y', $end_date) }}</td>
                                        @else
                                            <td>{{$value->detail}}</td>
                                                <?php
                                                $start_date = strtotime($value->start_date);
                                                $end_date = strtotime($value->end_date);
                                                ?>
                                            <td class="time">{{ date('d-m-Y', $start_date) }}</td>
                                            <td class="time">{{ date('d-m-Y', $end_date) }}</td>
                                        @endif
                                        @if ($value->status == 'Hoàn thành')
                                            <td style="background-color: greenyellow;color:black">
                                                {{ $value->status }}</td>
                                        @else
                                            <td style="background-color: #ff4a52;color: black">
                                                {{ $value->status }}</td>
                                        @endif
                                            
                                            <td>
                                                <a class="btn btn-secondary "
                                                    href={{route('staff.history-work', ['id' => $value->id])}}>
                                                    <i class="fas fa-history"></i>
                                                    Lịch sử
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
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
