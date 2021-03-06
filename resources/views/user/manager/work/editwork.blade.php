@extends('user.master.master')
@section('title', 'Chỉnh sửa công việc')
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
                        <h3 class="card-title">Chỉnh sửa công việc nhân viên</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <form method="post" action="{{ route('check-job.update', ['id' => $work->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Công việc</label>
                                <textarea type="text" class="form-control" name="detail">{{ $work->detail }}</textarea>
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" style="display: none" readonly value="{{ $work->id }}" name="id">
                            </div>
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" class="form-control dateform"
                                    value="{{ old('time') ?? date('Y-m-d', strtotime($work->start_date)) }}"
                                    name="start_date">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input type="date" class="form-control dateform"
                                    value="{{ old('time') ?? date('Y-m-d', strtotime($work->end_date)) }}"
                                    name="end_date">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Xác nhận</label>
                                <select name="check" class="form-control">
                                    <option value="0" {{$work->check == 0 ? 'selected' : ''}}>Không xác nhận</option>
                                    <option value="1" {{$work->check == 1 ? 'selected' : ''}}>Xác nhận</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a class="btn btn-danger" href="{{ route('check.list') }}">Đóng</a>
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
