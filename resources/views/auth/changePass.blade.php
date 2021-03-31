@extends('master.master')
@section('title','Đổi mật khẩu')
@section('content')
<style>
    input{
        width: 500px !important;
    };
    
</style>
    <div class="content-wrapper">
        <div class="container">
            <h1 style="text-align: center">Đổi mật khẩu</h1>
            <hr>
            <form 
                method="post"
                action="{{route('updatePass')}}"
                style="text-align: -webkit-center !important">
                @csrf
                <div class="form-group">
                    <label>Mật khẩu cũ</label>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-field" class="form-control pass_show" placeholder="Nhập mật khẩu cũ" name="oldPassword" >
                    @error('oldPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <span toggle="#password-new" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-new" class="form-control pass_show" value="{{old('newPassword')}}" placeholder="Nhập mật khẩu mới" name="newPassword">
                    @error('newPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <span toggle="#password-re" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-re" class="form-control pass_show"  placeholder="Nhập lại mật khẩu mới" name="rePassword">
                    @error('rePassword')
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
