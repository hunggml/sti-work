@extends('user.master.master')
@section('title', 'Hồ sơ')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="panel panel-info">
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                    @foreach ($user as $key => $value)
                                        <tr class="profile">
                                            <td class="profile">Tên</td>
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
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <a href={{ route('profile.edit', ['id' => $value->id]) }} class="btn btn-success">
                                <i class="far fa-edit"></i> Cập nhật hồ sơ</a>
                            <a href={{ route('changePass') }} class="btn btn-primary" style="color: white">
                                <i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a>
                            <a href={{ route('home') }} class="btn btn-danger"><i class="fas fa-times"></i> Đóng</a>
                            <a style="float: right" href={{route('profile.destroy')}} class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete?')">
                            <i class="fas fa-trash"></i> Xoá tài khoản</a>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    </div>

@endsection