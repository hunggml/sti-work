@extends('user.master.master')
@section('title','Đổi mật khẩu')
@section('content')
<style>
    input{
        width: 360px !important;
    };
    
</style>
    <div class="content-wrapper">
        <div class="container">
            <h1 style="text-align: center">Đổi mật khẩu</h1>
            <hr>
            <form
                id="Change_Pass"
                method="post"
                action="{{route('updatePass')}}"
                style="text-align: -webkit-center !important">
                @csrf
                <div class="form-group">
                    <label>Mật khẩu cũ</label>
                    <span toggle="#password_field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password_field" class="form-control pass_show" placeholder="Nhập mật khẩu cũ" name="oldPassword" >
                    @error('oldPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <span toggle="#password_new" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password_new" class="form-control pass_show" value="{{old('newPassword')}}" placeholder="Nhập mật khẩu mới" name="newPassword">
                    @error('newPassword')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <span toggle="#password_re" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <input type="password" id="password_re" class="form-control pass_show"  placeholder="Nhập lại mật khẩu mới" name="rePassword">
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
{{-- @push('script')
    
    <script>
    $(document).ready(function(){

        if($("#Change_Pass").length > 0)
         {
           $('#Change_Pass').validate({
             rules:{
                oldPassword : {
                 required : true,
                 minlength : 3,
                //  password : true
               },
               newPassword : {
                   required : true,
                   minlength : 3
               },
               rePassword : {
                   required : true,
                   minlength : 3,
                //    equalTo: newPassword
               }
             }
            //  messages : {
            //     oldPassword : {
            //      required : 'oldPassword field is required.',
            //      minlength : 'minlength must be at least 3'
            //    },
            //    newPassword : {
            //        required : 'password_new field is required.',
            //      minlength : 'minlength must be at least 3'
            //    },
            //    rePassword : {
            //        required : 'password_re field is required.',
            //      minlength : 'minlength must be at least 3',
            //      equalTo : 'Re Pass is not match'
            //    }
            //  }
           });
         }
        });

       </script>
@endpush --}}

@endsection
