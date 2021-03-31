@extends('master.master')
@section('title', 'Hồ sơ')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container">
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        @foreach ($user as $key => $value)
                                            <tr>
                                                <td>Tên</td>
                                                <td>: {{ $value->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tài khoản đăng nhập</td>
                                                <td>: {{ $value->username }}</td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại</td>
                                                <td>: {{ $value->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Địa chỉ</td>
                                                <td>: {{ $value->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td>: {{ $value->email }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-right">
                            <a href={{ route('profile.edit', ['id' => $value->id]) }} class="btn btn-success">
                                <i class="far fa-edit"></i> Cập nhật hồ sơ</a>
                            <a href={{ route('changePass') }} class="btn btn-primary" style="color: white">
                                <i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a>
                            <a style="float: right" href={{ route('home') }} class="btn btn-danger"><i
                                    class="fas fa-times"></i> Đóng</a>
                        </span>
                    </div>
                </div>
            </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

@endsection
