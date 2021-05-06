@extends('user.master.master')
@section('title', 'Danh sách nhân viên')
@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách nhân viên</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Phòng ban</th>
                                    <th colspan="4">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    @if ($user->level == 0)
                                        <tr hidden></tr>
                                    @else
                                        <tr>
                                            @if ($user->image == null)
                                                <td style="text-align: center">
                                                    <img src="{{ asset('img/user.png') }}"
                                                        style="width: 50px;height:50px;border-radius: 50%;"
                                                        class="elevation-2" alt="User Image">
                                                </td>
                                            @else
                                                <td style="text-align: center">
                                                    <img style="width: 50px;height:50px;border-radius: 50%;"
                                                        class="img-user" src={{ asset($user->image) }} alt="user image">
                                                </td>
                                            @endif
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($user->level == '1')
                                                <td>Quản lý</td>
                                            @else
                                                <td>Nhân viên</td>
                                            @endif
                                            <td>{{ $user->group->name }}</td>

                                            <td><a class="btn btn-success edit"
                                                    href="{{ route('staff.adminEditLevel', ['id' => $user->id]) }}">
                                                    <i class="far fa-edit"></i>
                                                    Chỉnh sửa
                                                </a>
                                            </td>
                                            <td>
                                                <a href={{ route('staff.adminWorkStaff', ['id' => $user->id]) }}
                                                    class="btn btn-success ">
                                                    <i class="fas fa-briefcase"></i> Công việc
                                                </a>
                                            </td>
                                            <td>
                                                @if ($user->metting == 0 || $user->metting == 3)
                                                    <a class="btn btn-success edit"
                                                        href='{{ route('metting', ['metting' => 1, 'id' => $user->id]) }}'>
                                                        <i class="fas fa-walking"></i> Điều công tác
                                                    </a>
                                                @endif

                                            </td>
                                            @if ($auth->id == $user->id)
                                                <td></td>
                                            @else
                                                <td>
                                                    <a href="{{ route('staff.adminDestroy', ['id' => $user->id]) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                        <i class="far fa-trash-alt"></i>
                                                        Xoá nhân viên
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
