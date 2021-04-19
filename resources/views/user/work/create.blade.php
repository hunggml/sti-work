@extends('user.master.master')
@section('title', 'Thêm công việc')
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
                        <h3 class="card-title">Thêm công việc</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <form action={{ route('work.store') }} method="post">
                            @csrf
                            <div class="form-group">
                                <label>Công Việc</label>
                                <textarea type="text" class="form-control "
                                    name="detail" placeholder="Nhập công việc cụ thể">{{ old('detail') }}</textarea>
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" value="{{ old('start_date') }}"
                                    class="form-control " name="start_date"
                                    placeholder="Enter start date">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input type="date" value="{{ old('end_date') }}"
                                    class="form-control" 
                                    min ="{{ Carbon\Carbon::now()->format('Y-m-d') }}" 
                                    name="end_date"
                                    placeholder="Enter end date">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control" readonly>
                                    {{-- <option value="Hoàn thành">Hoàn thành</option> --}}
                                    <option value="Chưa hoàn thành">Chưa hoàn thành</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" value=0 class="form-control " name="check" style="display: none">
                            </div>
                            <div class="form-group">
                                <input type="number" value=0 class="form-control " name="progress" style="display: none">
                            </div>
                            <div class="form-group">
                                <input type="number" value=0 class="form-control " name="hidden" style="display: none">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Thêm việc</button>
                                <a class="btn btn-danger" href="{{ route('work.index') }}">Đóng</a>
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