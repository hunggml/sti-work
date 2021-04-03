@extends('user.master.master')
@section('title', 'Danh sách nhân viên')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách nhân viên</h3>
                    </div>
                    <div class="card-body" id="car-body">

                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->email }}</td>
                                        @if ($user->level ===1)
                                            <td>Quản trị</td>
                                        @else 
                                            <td>Nhân viên</td>
                                        @endif
                                     
                                        <td><a class="btn btn-success edit"
                                                href="{{ route('staff.editLevel', ['id' => $user->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Chỉnh sửa level
                                            </a>
                                            <a href="{{ route('staff.destroy', ['id' => $user->id]) }}"
                                                class="btn btn-danger"
                                                style="float: right;"
                                                onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                <i class="far fa-trash-alt"></i>
                                                Xoá nhân viên
                                            </a>
                                        </td>
                                    </tr>

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
