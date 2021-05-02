@extends('user.master.master')
@section('title', 'Danh sách công việc')
@section('metting')
    <p style="color: black">Người họp : {{ $metting->name }} </p>
    <p style="color: black">Người tiếp theo : {{ $secorndMetting->name }} </p>
@endsection
@section('content')
<style>
    /* img-user {
        width: 100px !important;
        height: 100px !important;
    } */
</style>
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
                                    <th>Ảnh</th>
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
                                            @if ($value0->image == null)
                                                    <td style="text-align: center">
                                                        <img src="{{ asset('img/user.png') }}" class="elevation-2" style="width: 50px;height:50px;border-radius: 50%;" alt="User Image">
                                                    </td>
                                                @else
                                                    <td style="text-align: center">
                                                        <img style="width: 50px;height:50px;border-radius: 50%;"  class="img-user" src={{$value0->image}} alt="user image">
                                                    </td>    
                                                @endif
                                            <td>
                                                <p>{{ $value0->name }}</p>
                                                @foreach ($array as $key3 => $arr)
                                                    @if ($value0->id == $key3)
                                                        @if ($value0->progress != 0)
                                                            <p style="color: red">{{ $arr }}</p>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
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
                                                @if ($value->user->image == null)
                                                    <td rowspan="{{ $work->count() }}" style="text-align: center">
                                                        <img src="{{ asset('img/user.png') }}" style="width: 50px;height:50px;border-radius: 50%; text-align:center" class="elevation-2" alt="User Image">
                                                    </td>
                                                @else
                                                    <td rowspan="{{ $work->count() }}" style="text-align: center">
                                                        <img style="width: 50px;height:50px;border-radius: 50%;text-align:center" src={{$value->user->image}} alt="user image">
                                                    </td>
                                                @endif
                                                    <td rowspan="{{ $work->count() }}">
                                                        <p>{{ $value->user->name }}</p>
                                                        @foreach ($array as $key4 => $arr1)
                                                            @if ($value->user_id == $key4)
                                                                @if ($value->user->progress != 0)
                                                                    <p style="color: red"> {{ $arr1 }}</p>
                                                                @endif
                                                                
                                                            @endif
                                                        @endforeach 
                                                    </td>
                                            @endif
                                            @if ($date->diffInDays($value->end_date, false) == 0)
                                                <td class="check-time">{{$value->detail}}</td>
                                                    <?php
                                                    $start_date = strtotime($value->start_date);
                                                    $end_date = strtotime($value->end_date);
                                                    ?>
                                                <td class="check-time time">{{ date('d-m-Y', $start_date) }}</td>
                                                <td class="check-time time">{{ date('d-m-Y', $end_date) }}</td>
                                            @elseif ($date->diffInDays($value->end_date,false) < 0) 
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
