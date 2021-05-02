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
                        {{-- <a href="{{ url('/home') }}/export/staff/xlsx" style="color: white;" class="btn btn-success mb-2">
                            <i class="fas fa-download"></i> Xuất excel
                        </a> --}}
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
                                @foreach ($users->groupBy('group_id') as $key => $value)
                                    @if ($value->first()->group_id == Auth::user()->group_id)
                                        @foreach ($value as $user)
                                            <tr>
                                                @if ($user->image == null)
                                                    <td style="text-align: center">
                                                        <img src="{{ asset('img/user.png') }}" style="width: 50px;height:50px;border-radius: 50%;" class="elevation-2" alt="User Image">
                                                    </td>
                                                @else
                                                    <td style="text-align: center">
                                                        <img style="width: 50px;height:50px;border-radius: 50%;" class="img-user" src={{asset($user->image)}} alt="user image">
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
                                                        href="{{ route('staff.editLevel', ['id' => $user->id]) }}">
                                                        <i class="far fa-edit"></i>
                                                        Chỉnh sửa
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href={{route('staff.listwork',['id'=>$user->id])}} class="btn btn-success ">
                                                        <i class="fas fa-briefcase"></i> Công việc
                                                    </a>
                                                </td> 
                                                <td>
                                                    @if ($user->metting == 0)
                                                    <a class="btn btn-success edit" href= '{{route('metting',['metting' => 1, 'id' => $user->id ])}}'>
                                                        <i class="fas fa-walking"></i> Điều công tác
                                                    </a>
                                                    @endif
                                                    
                                                </td>
                                                @if ($auth->id == $user->id)
                                                    <td></td>
                                                @else
                                                <td>
                                                    <a href="{{ route('staff.destroy', ['id' => $user->id]) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                        <i class="far fa-trash-alt"></i>
                                                        Xoá nhân viên
                                                    </a>
                                                </td>
                                                @endif
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
