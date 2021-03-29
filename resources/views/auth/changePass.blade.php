@extends('master.master')
@section('title','Change Password')
@section('content')
<style>
    input{
        width: 500px !important;
    };
    
</style>
    <div class="content-wrapper">
        <div class="container">
            <h1 style="text-align: center">Change password</h1>
            <hr>
            <form 
                method="post"
                action="{{route('updatePass')}}"
                style="text-align: -webkit-center !important">
                @csrf
                <div class="form-group">
                    <label>Old Password</label>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-field" class="form-control pass_show" placeholder="Enter old password" name="oldPassword" >
                    @error('oldPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <span toggle="#password-new" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-new" class="form-control pass_show" value="{{old('newPassword')}}" placeholder="Enter new password" name="newPassword">
                    @error('newPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Return password</label>
                    <span toggle="#password-re" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password-re" class="form-control pass_show"  placeholder="Enter confirmed password" name="rePassword">
                    @error('rePassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger" href="{{route('home')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>


@endsection
