@extends('user.master.master')
@section('title', 'Danh sách công việc')

@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-body" id="car-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tên nhân viên</th>
                                    <th>Công việc</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Tình trạng</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users->groupBy('group_id') as $key => $value0)
                                    @if ($value0->first()->group_id == Auth::user()->group_id)
                                        @foreach ($value0 as $key1 => $value)
                                            @foreach ($value->work as $key2 => $work)
                                                <tr>
                                                    @if ($key2 == 0)
                                                        <td rowspan="{{ $value->work->count() }}">
                                                            {{ $value->name }}
                                                        </td>
                                                    @endif
                                                    @if ($date->diffInDays($work->end_date, false) == 0)
                                                            <td class="check-time">{{$work->detail}}</td>
                                                                <?php
                                                                $start_date = strtotime($work->start_date);
                                                                $end_date = strtotime($work->end_date);
                                                                ?>
                                                            <td class="check-time time">{{ date('d-m-Y', $start_date) }}
                                                            </td>
                                                            <td class="check-time time">{{ date('d-m-Y', $end_date) }}
                                                            </td>
                                                    @elseif ($date->diffInDays($work->end_date,false) < 0) 
                                                            <td class="check-timeOut">{{$work->detail}}</td>
                                                                <?php
                                                                $start_date = strtotime($work->start_date);
                                                                $end_date = strtotime($work->end_date);
                                                                ?>
                                                            <td class="check-timeOut time">
                                                                {{ date('d-m-Y', $start_date) }}</td>
                                                            <td class="check-timeOut time">
                                                                {{ date('d-m-Y', $end_date) }}</td>
                                                    @else
                                                            <td class="">{{$work->detail}}</td>
                                                            <td class="time">{{ $work->start_date }}</td>
                                                            <td class="time">{{ $work->end_date }}</td>
                                                    @endif
                                                    <td>Chưa xác nhận</td>
                                                    <td>
                                                        <a class="btn btn-success edit"
                                                            href="{{ route('check-job.edit', ['id' => $work->id]) }}">
                                                            <i class="far fa-edit"></i>
                                                            Chỉnh sửa và xác nhận
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('check-job.destroy', ['id' => $work->id]) }}"
                                                            class="btn btn-danger" style="float: right;"
                                                            onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                            <i class="far fa-trash-alt"></i>
                                                            Xoá
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        @foreach ($value0 as $key1 => $value)
                                            @if ($value->work->count() == 0)
                                                <tr>
                                                    <td>{{ $value->name }}</td>
                                                    <td style="background-color: #f13149"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="3"></td>
                                                </tr>
                                            @endif
                                        @endforeach
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

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
@endsection
