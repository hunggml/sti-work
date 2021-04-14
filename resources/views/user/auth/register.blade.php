<!doctype html>
<html lang="en">
<head>
    <title>Đăng ký</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="180x180" href="{{asset('img/logo.jpeg')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
       <!-- Toastr -->
       {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
       @toastr_css

</head>
<body style='background-image: url("../img/backkkk.jpg");'>
<div class="login-wrap">
    <div class="login-html">
        
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng ký</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <form action={{route('register')}} method="post">
                @csrf
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="name" class="label">Họ và tên</label>
                            <input id="name" value="{{old('name')}}" name="name" type="text"
                                   class="input">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="username" class="label">Tài khoản đăng nhập</label>
                            <input id="username" value="{{old('username')}}" name="username" type="text"
                                   class="input">
                            @error('username')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="password" class="label">Mật khẩu</label>
                            <input id="password" value="{{old('password')}}" name="password" type="password"
                                   class="input" data-type="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="re-password" class="label">Nhập lại mật khẩu</label>
                            <input id="re-password"  name="re-password" type="password"
                                   class="input" data-type="password">
                            @error('re-password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br> 
                        <div class="group">
                            <input type="submit" class="button" value="Đăng ký">
                        </div>
                        <div class="foot-lnk">
                            <a style="color: white" href={{route('loginShow')}}>Bạn đã có tài khoản?</a>
                        </div>
                        <hr>
                        <div class="foot-lnk">
                            <a style="color: white" href={{ route('trangchu') }}>Quay lại</a>
                        </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
             <!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@jquery
@toastr_js
@toastr_render

</body>
</html>
