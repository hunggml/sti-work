@extends('user.master.master')
@section('title', 'Thống kê')
@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
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
                                        @if ($user->level == 0)
                                            <tr hidden></tr>
                                        @else
                                            @if ($value->detail !== null)
                                                <tr>
                                                    @if ($key1 == 0)
                                                        <td rowspan="{{ $user->work->count() }}">
                                                            {{ $user->name }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $value->detail }}</td>
                                                    <td>{{ $value->time_updated }}</td>
                                                    <td>{{ $value->end_date }}</td>
                                                    @if ($value->progress == 2)
                                                        <td class="out-time">Quá hạn</td>
                                                    @elseif ($value->progress == 1)
                                                        <td class="on-time">Đúng hạn</td>
                                                    @else
                                                        <td>Chưa đến hạn</td>
                                                    @endif
                                                </tr>
                                            @else
                                                <tr>
                                                    @if ($key1 == 0)
                                                        <td rowspan="{{ $user->work->count() }}">
                                                            {{ $user->name }}
                                                        </td>
                                                    @endif
                                                    <td hidden></td>
                                                    <td hidden></td>
                                                    <td hidden></td>
                                                    <td hidden></td>
                                                </tr>
                                            @endif
                                        @endif

                                    @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        <br>
                        <span style="float: right">{{ $users->links() }}</span>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
