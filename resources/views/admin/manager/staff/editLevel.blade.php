@extends('user.master.master')
@section('title', 'Chỉnh sửa nhân viên')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa nhân viên</h1>
            <hr>
            <form method="post"
                  action="{{route('staff.adminUpdateLevel',['id' => $user->id])}}">
                @csrf
                <div class="form-group">
                    <label>Nhân viên: </label>
                    <strong style="color: black;font-size:20px">{{$user->name}}</strong>
                </div>
                <div class="form-group">
                    <label>Cấp độ</label>
                    <select class="form-control" name="level">
                            <option value="1" {{$user->level == 1 ? 'selected' : ''}}>Quản lý</option>
                            <option value="2" {{$user->level == 2 ? 'selected' : ''}}>Nhân viên</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phòng ban</label>                    
                    <select class="form-control" name="group_id"> 
                        @foreach($groups as $value)
                            <option value="{{$value->id}}" {{$user->group_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('staff.adminStaffList')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>

@endsection
