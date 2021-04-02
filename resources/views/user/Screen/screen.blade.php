@extends('user.master.master')
@push('mycss')
    <style>
        .my-text {
            font-size: 20px;
            border: 0;
            color: black;
        }

        .my-sologan {
            font-size: 20px;
            border: 0;
            color: black;
            text-align: center
        }

    </style>
@endpush
@section('title', 'Danh sách công việc')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div id="time" class="col-md-2 my-text" disabled></div>
                            {{-- <input type="datetime" value="{{Carbon\Carbon::now()}}"> --}}
                            <div class="col-md-8 my-sologan">Sáng tạo -Triệt để - Cam kết</div>
                        </div>
                    </div>
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
                                @foreach ($user as $key => $value0)
                                    @foreach ($value0->work as $key1 => $value)
                                        @if ($value->detail == null)
                                            <tr>
                                                <td rowspan="{{ $value0->work->count() }}">
                                                    {{ $value0->name }}
                                                </td>
                                                <td style="background-color: #f13149">{{ $value->detail }}</td>
                                                <td>{{ $value->start_date }}</td>
                                                <td>{{ $value->end_date }}</td>
                                            </tr>
                                        @elseif ($date->diffInDays($value->end_date,false) == 0)
                                            @if ($key1 == 0)
                                                <tr>
                                                    <td rowspan="{{ $value0->work->count() }}">
                                                        {{ $value0->name }}</td>
                                                    <td class="check-time">{{ $value->detail }}</td>
                                                    <td class="check-time">{{ $value->start_date }}</td>
                                                    <td class="check-time">{{ $value->end_date }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="check-time">{{ $value->detail }}</td>
                                                    <td class="check-time">{{ $value->start_date }}</td>
                                                    <td class="check-time">{{ $value->end_date }}</td>
                                                </tr>
                                            @endif
                                        @elseif ($date->diffInDays($value->end_date,false) < 0) 
                                            @if ($key1 == 0) 
                                                <tr>
                                                    <td rowspan="{{ $value0->work->count() }}">
                                                        {{ $value0->name }}</td>
                                                    <td class="check-timeOut">{{ $value->detail }}</td>
                                                    <td class="check-timeOut">{{ $value->start_date }}</td>
                                                    <td class="check-timeOut">{{ $value->end_date }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="check-timeOut">{{ $value->detail }}</td>
                                                    <td class="check-timeOut">{{ $value->start_date }}</td>
                                                    <td class="check-timeOut">{{ $value->end_date }}</td>
                                                </tr> 
                                            @endif 
                                        @else 
                                            <tr>
                                                @if ($value->check === 0)
                                                    <td rowspan="{{ $value0->work->count() }}">
                                                        {{ $value0->name }}</td>
                                                @endif
                                                    <td>{{ $value->detail }}</td>
                                                    <td>{{ $value->start_date }}</td>
                                                    <td>{{ $value->end_date }}</td>
                                            </tr>
                                        @endif
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
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

@endsection
