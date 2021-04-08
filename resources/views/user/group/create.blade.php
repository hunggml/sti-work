@extends('user.master.master')
@section('title', 'Thêm phòng ban')
@section('content')
    <style>
        .card-body {
            display: flex;
            justify-content: center;
        }
        form {
            text-align: center;
            width: 600px;
        }
    </style>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm phòng ban</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <form action={{ route('group.store') }} method="post">
                            @csrf
                            <div class="form-group">
                                <label>Công Việc</label>
                                <textarea type="text" class="form-control @error('name') border-danger @enderror"
                                    name="name" placeholder="Nhập tên phòng ban">{{ old('name') }}</textarea>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div>
                                <button type="submit" class="btn btn-primary">Thêm phòng ban</button>
                                <a class="btn btn-danger" href="{{ route('group.list') }}">Đóng</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection