@extends('master.master')
@section('title','Chỉnh sửa hồ sơ')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa hồ sơ</h1>
            <hr>
            <form
                method="post"
                action="{{ route('profile.update')}}">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" name="name"
                           value="{{ $user->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" style="display: none" readonly value="{{$user->id}}" name="id">
                </div>
                {{-- <div class="form-group">
                    <label>tài khoản đăng nhập</label>
                    <input type="text" class="form-control" name="username"
                           value="{{ $user->username }}">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="number" class="form-control" name="phone"
                           value="{{ $user->phone }}">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" name="address"
                           value="{{ $user->address }}">
                    @error('address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email"
                           value="{{ $user->email }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('profile.index')}}">Đóng</a>
                </div>
            </form>
            
        </div>
    </div>

@endsection
