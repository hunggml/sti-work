@extends('user.master.master')
@section('title', 'Hồ sơ')
@section('content')
    <style>
        .dropdown-menu {
            left: 75px !important;
        }

        article,
        aside,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

    </style>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-body" id="car-body">
                        <div class="panel panel-info">
                            <div class="row">
                                <div class=" col-md-9 col-lg-9 ">
                                    <table class="table table-user-information">
                                        <tbody>
                                            @foreach ($user as $key => $value)
                                                <tr class="profile">
                                                    <td class="profile">Họ và tên</td>
                                                    <td class="profile">: {{ $value->name }}</td>
                                                </tr>
                                                <tr class="profile">
                                                    <td class="profile">Tài khoản đăng nhập</td>
                                                    <td class="profile">: {{ $value->username }}</td>
                                                </tr>
                                                <tr class="profile">
                                                    <td class="profile">Số điện thoại</td>
                                                    <td class="profile">: {{ $value->phone }}</td>
                                                </tr>
                                                <tr class="profile">
                                                    <td class="profile">Địa chỉ</td>
                                                    <td class="profile">: {{ $value->address }}</td>
                                                </tr>
                                                <tr class="profile">
                                                    <td class="profile">Email</td>
                                                    <td class="profile">: {{ $value->email }}</td>
                                                </tr>
                                                <tr class="profile">
                                                    <td class="profile">Phòng ban</td>
                                                    <td class="profile">: {{ $value->group->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <a href={{ route('profile.edit', ['id' => $value->id]) }} class="btn btn-success">
                                        <i class="far fa-edit"></i> Cập nhật hồ sơ</a>
                                    <a href={{ route('changePass') }} class="btn btn-primary" style="color: white">
                                        <i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a>
                                    <a style="color: white" class="btn btn-success" data-toggle="modal" data-target="#groupModal"
                                        aria-labelledby="dropdownMenuLink">
                                        <i class="far fa-edit"></i> Chọn phòng ban</a>
                                    <hr>
                                    <a href={{ route('home') }} class="btn btn-danger"><i class="fas fa-times"></i>
                                        Đóng</a>
                                    <hr>

                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <a href=# class="btn btn-secondary dropdown-toggle " role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ($auth->image != null)
                                            <img class="img-circle elevation-2" style="width: 300px;height:300px"
                                                alt="User Image" src='{{ asset("$auth->image") }}'>
                                        @else
                                            <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2"
                                                style="width: 300px;height:300px" alt="User Image">
                                        @endif
                                    </a>
                                    <div class="dropdown-menu" style="position: fixed" data-toggle="modal"
                                        data-target="#exampleModal" aria-labelledby="dropdownMenuLink">
                                        <a class="btn"><i class="fas fa-images"></i> Cập nhật ảnh đại diện</a>
                                    </div>
                                </div>
                            </div>
                            <a style="float: right" href={{ route('profile.destroy') }} class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete?')">
                                <i class="fas fa-trash"></i> Xoá tài khoản
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>

    </div>
    {{-- modal upload avatar --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn ảnh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.upload-avatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input onchange="readURL(this);" type="file" name="image">
                            <img id="blah" src="#" alt="Ảnh của bạn" />
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal choice group --}}
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn phòng ban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.choice-group') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Phòng ban</label>
                            <select class="form-control" name="group_id">
                                @foreach ($groups as $value)
                                    <option value="{{ $value->id }}"
                                        {{ $auth->group_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
