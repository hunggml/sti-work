@extends('user.master.master')
@section('title', 'Chỉnh sửa level')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa Level</h1>
            <hr>
            <form method="post"
                  action="{{route('staff.updateLevel',['id' => $user->id])}}">
                @csrf
                <div class="form-group">
                    {{-- <lable><b>Role</b></lable> --}}
                    <br>
                    <br>
                    <select class="form-control" name="level">
                            <option value="1">Quản trị</option>
                            <option value="2">Nhân viên</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('staff.list')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>

@endsection
