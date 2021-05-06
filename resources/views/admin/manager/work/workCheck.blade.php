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
                                @foreach ($users as $key => $value0)
                                    @foreach ($value0->work as $key2 => $work)
                                        @if ($value0->level == 0)
                                            <tr hidden></tr>
                                        @else
                                            <tr>
                                                @if ($key2 == 0)
                                                    <td rowspan="{{ $value0->work->count() }}">
                                                        {{ $value0->name }}
                                                    </td>
                                                @endif
                                                @if ($date->diffInDays($work->end_date, false) == 0)
                                                    <td class="check-time">{{ $work->detail }}</td>
                                                    <?php
                                                    $start_date = strtotime($work->start_date);
                                                    $end_date = strtotime($work->end_date);
                                                    ?>
                                                    <td class="check-time time">{{ date('d-m-Y', $start_date) }}
                                                    </td>
                                                    <td class="check-time time">{{ date('d-m-Y', $end_date) }}
                                                    </td>
                                                @elseif ($date->diffInDays($work->end_date,false) < 0) <td
                                                        class="check-timeOut">{{ $work->detail }}</td>
                                                        <?php
                                                        $start_date = strtotime($work->start_date);
                                                        $end_date = strtotime($work->end_date);
                                                        ?>
                                                        <td class="check-timeOut time">
                                                            {{ date('d-m-Y', $start_date) }}</td>
                                                        <td class="check-timeOut time">
                                                            {{ date('d-m-Y', $end_date) }}</td>
                                                    @else
                                                        <td class="">{{ $work->detail }}</td>
                                                        <td class="time">{{ $work->start_date }}</td>
                                                        <td class="time">{{ $work->end_date }}</td>
                                                @endif
                                                <td>Chưa xác nhận</td>
                                                <td>
                                                    <a class="btn btn-success edit"
                                                        href="{{ route('check-job.admineditWorkCheck', ['id' => $work->id]) }}">
                                                        <i class="far fa-edit"></i>
                                                        Chỉnh sửa và xác nhận
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="{{ route('check-job.adminDeleteWorkCheck', ['id' => $work->id]) }}"
                                                        class="btn btn-danger" style="float: right;"
                                                        onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                        <i class="far fa-trash-alt"></i>
                                                        Xoá
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($users as $key1 => $value0)
                                    @if ($value0->work->count() == 0)
                                        @if ($value0->level == 0)
                                            <tr hidden></tr>
                                        @else
                                            <tr>
                                                <td>{{ $value0->name }}</td>
                                                <td style="background-color: #f13149"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        @endif
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
