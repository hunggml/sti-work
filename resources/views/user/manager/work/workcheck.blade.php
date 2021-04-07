@extends('user.master.master')

@section('title', 'Danh sách công việc')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách công việc cần xác nhận</h3>
                    </div>
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
                                @foreach ($user as $key => $value0)
                                    @if ($value0->work->count() == 0)
                                        <tr>
                                            <td>{{ $value0->name }}</td>
                                            <td style="background-color: #f13149"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    @else
                                        @foreach ($value0->work as $key1 => $value)
                                            <tr>
                                                @if ($key1 == 0)
                                                    <td rowspan="{{ $value0->work->count() }}">
                                                        {{ $value0->name }}
                                                    </td>
                                                @endif
                                                @if ($date->diffInDays($value->end_date, false) == 0)
                                                    <td class="check-time detail">{{ $value->detail }}</td>
                                                    <td class="check-time time">{{ $value->start_date }}</td>
                                                    <td class="check-time time">{{ $value->end_date }}</td>
                                                @elseif ($date->diffInDays($value->end_date,false) < 0) 
                                                    <td class="check-timeOut detail">{{ $value->detail }}</td>
                                                    <td class="check-timeOut time">{{ $value->start_date }}</td>
                                                    <td class="check-timeOut time">{{ $value->end_date }}</td>
                                                @else
                                                    <td class="detail">{{ $value->detail }}</td>
                                                    <td class="time">{{ $value->start_date }}</td>
                                                    <td class="time">{{ $value->end_date }}</td>
                                                @endif
                                                    <td>Chưa xác nhận</td>
                                                    <td>
                                                        <a class="btn btn-success edit"
                                                            href="{{ route('check-job.edit', ['id' => $value->id]) }}">
                                                            <i class="far fa-edit"></i>
                                                            Chỉnh sửa và xác nhận
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('check-job.destroy', ['id' => $value->id]) }}"
                                                            class="btn btn-danger" style="float: right;"
                                                            onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                            <i class="far fa-trash-alt"></i>
                                                            Xoá
                                                        </a>
                                                    </td>
                                            </tr>
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
