@extends('user.master.master')
@section('title', 'Danh sách công việc cá nhân')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách công việc cá nhân</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <a style="color: white" class="btn btn-primary mb-2" href={{ route('work.create') }}>Thêm việc
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
                                            <td>{{ ++$key }}</td>
                                            <td id="detail">{{ $value->detail }}</td>
                                            <td>{{ $value->start_date }}</td>
                                            <td id="end_date">{{ $value->end_date }}</td>
                                            @if ($value->status == 'Hoàn thành')
                                                <td style="background-color: greenyellow;color:black">
                                                    {{ $value->status }}</td>
                                            @else
                                                <td style="background-color: #ff4a52;color: black">
                                                    {{ $value->status }}</td>
                                            @endif
                                            <td><a class="btn btn-success edit"
                                                    href={{ route('work.edit', ['id' => $value->id]) }}>
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('work.destroy', ['id' => $value->id]) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @else 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                        @if($date->diffInDays($value->end_date, false) == 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-time">{{ $value->detail }}</td>
                                            <td class="check-time time">{{ $value->start_date }}</td>
                                            <td class="check-time time">{{ $value->end_date }}</td>
                                        @elseif ($date->diffInDays($value->end_date,false) < 0 && $value->status == 'Chưa hoàn thành')
                                            <td class="check-timeOut">{{ $value->detail }}</td>
                                            <td class="check-timeOut time">{{ $value->start_date }}</td>
                                            <td class="check-timeOut time">{{ $value->end_date }}</td>
                                        @else
                                            <td>{{ $value->detail }}</td>
                                            <td class="time">{{ $value->start_date }}</td>
                                            <td class="time">{{ $value->end_date }}</td>
                                        @endif
                                            @if ($value->status == 'Hoàn thành')
                                                <td style="background-color: greenyellow;color:black">
                                                    {{ $value->status }}</td>
                                            @else
                                                <td style="background-color: #ff4a52;color: black">
                                                    {{ $value->status }}</td>
                                            @endif
                                            <td><a class="btn btn-success "
                                                    href={{ route('work.edit', ['id' => $value->id]) }}>
                                                    <i class="far fa-edit"></i>
                                                    {{-- Chỉnh sửa công việc --}}
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
