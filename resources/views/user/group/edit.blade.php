@extends('user.master.master')
@section('title', 'Chỉnh sửa phòng ban')
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
                        <h3 class="card-title">Chỉnh sửa phòng ban</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <form method="post" action="{{ route('group.update') }}">
                            @csrf
                            <div class="form-group">
                                <label>Phòng ban</label>
                                <textarea type="text" class="form-control" name="name">{{ $group->name }}</textarea>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" style="display: none" readonly value="{{ $group->id }}" name="id">
                            </div>
                           
                            <div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
