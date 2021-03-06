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
                        {{-- <a href="{{ route('exportWork')}}" style="color: white;" class="btn btn-success mb-2">
                            <i class="fas fa-download"></i> Xuất excel
                        </a> --}}
                        <a style="color: white;float:right !important" class="btn btn-secondary mb-2"
                            href={{ route('warehouse.list') }}>
                            <i class="fas fa-warehouse"></i> Lưu trữ
                        </a>

                        <table id="worktable" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Công việc</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th colspan="3">Hành động</th>
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
                                                    <td class="check-time">{{ $value->detail }}</td>
                                                    <?php
                                                    $start_date = strtotime($value->start_date);
                                                    $end_date = strtotime($value->end_date);
                                                    ?>
                                                    <td class="check-time time">{{ date('d-m-Y', $start_date) }}</td>
                                                    <td class="check-time time">{{ date('d-m-Y', $end_date) }}</td>
                                            @elseif ($date->diffInDays($value->end_date,false) < 0 && $value->status == 'Chưa hoàn thành')
                                                    <td class="check-timeOut">{{ $value->detail }}</td>
                                                    <?php
                                                    $start_date = strtotime($value->start_date);
                                                    $end_date = strtotime($value->end_date);
                                                    ?>
                                                    <td class="check-timeOut time">{{ date('d-m-Y', $start_date) }}</td>
                                                    <td class="check-timeOut time">{{ date('d-m-Y', $end_date) }}</td>
                                            @else
                                                    <td>{{ $value->detail }}</td>
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
                                            <td><a class="btn btn-success "
                                                    href={{ route('work.edit', ['id' => $value->id]) }}>
                                                    <i class="far fa-edit"></i>
                                                </a>

                                            </td>
                                            <td>
                                                <a class="btn btn-secondary "
                                                    href={{ route('storage', ['id' => $value->id]) }}>
                                                    <i class="fas fa-warehouse"></i>

                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary "
                                                    href={{ route('work.history', ['id' => $value->id]) }}>
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
                        <p>
                            {{ $work->links() }}

                        </p>
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
