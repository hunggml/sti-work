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
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Phòng ban</th>
                                    <th colspan="5">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users->groupBy('group_id') as $key => $value)
                                    @if ($value->first()->group_id == Auth::user()->group_id)
                                        @foreach ($value as $user)
                                            <tr>
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
                                                        href="{{ route('staff.editLevel', ['id' => $user->id]) }}">
                                                        <i class="far fa-edit"></i>
                                                        Chỉnh sửa
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href={{route('staff.listwork',['id'=>$user->id])}} class="btn btn-success ">
                                                        Công việc
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($user->metting == 2)
                                                        <a class="btn btn-success edit" 
                                                        href= '{{route('metting',['metting' => 3, 'id' => $user->id ])}}'
                                                        onclick="return confirm('Bạn có chắc chắn là xác nhận công việc không ?')">
                                                            Xác nhận họp
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->metting == 0)
                                                    <a class="btn btn-success edit" 
                                                    href= '{{route('metting',['metting' => 1, 'id' => $user->id ])}}'>
                                                        Đi công tác
                                                    </a>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <a href="{{ route('staff.destroy', ['id' => $user->id]) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                        <i class="far fa-trash-alt"></i>
                                                        Xoá nhân viên
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
                </div>
            </section>
        </div>
    </div>
@endsection
