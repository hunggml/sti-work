@extends('master.master')
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
                        <table id="example1" class="table table-bordered table-striped ">
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
                                                    onclick="return confirm('Are you sure you want to delete?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->detail }}</td>
                                            <td>{{ $value->start_date }}</td>
                                            <td>{{ $value->end_date }}</td>
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
                                                    onclick="return confirm('Are you sure you want to delete?')">
                                                    <i class="far fa-trash-alt"></i>
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
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


@endsection
