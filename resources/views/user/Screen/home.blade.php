@extends('user.master.master')
@section('titleCustomer', 'Danh sách công việc')
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
                                    {{-- <th>Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $value0)
                                    @if ($value0->work_count == 0)
                                        <tr>
                                            <td>{{ $value0->name }}</td>
                                            <td style="background-color: #f13149"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                                @foreach ($works->groupBy('user_id') as $key1 => $work)
                                    @foreach ($work as $key2 => $value)
                                        <tr>
                                            @if ($key2 == 0)
                                                <td rowspan="{{ $work->count() }}">
                                                    {{ $value->user_name }}
                                                </td>
                                            @endif
                                            @if ($date->diffInDays($value->end_date, false) == 0)
                                                <td class="check-time">{{ $value->detail }}</td>
                                                <td class="check-time time">{{ $value->start_date }}</td>
                                                <td class="check-time time">{{ $value->end_date }}</td>
                                            @elseif ($date->diffInDays($value->end_date,false) < 0) <td
                                                    class="check-timeOut">{{ $value->detail }}</td>
                                                    <td class="check-timeOut time">{{ $value->start_date }}</td>
                                                    <td class="check-timeOut time">{{ $value->end_date }}</td>
                                                @else
                                                    <td>{{ $value->detail }}</td>
                                                    <td class="time">{{ $value->start_date }}</td>
                                                    <td class="time">{{ $value->end_date }}</td>
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

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
@endsection
