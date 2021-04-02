@extends('user.master.master')
@section('title','Chỉnh sửa công việc nhân viên')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa công việc nhân viên</h1>
            <hr>
            <form
                method="post"
                action="{{route('check-job.update',['id' => $work->id])}}">
                @csrf
                <div class="form-group">
                    <label>Công việc</label>
                    <textarea type="text" class="form-control" name="detail">{{$work->detail}}</textarea>
                    @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" style="display: none" readonly value="{{$work->id}}" name="id">
                </div>
                <div class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date" class="form-control dateform" 
                            style="width: 300px"
                            value="{{old('time')?? date('Y-m-d', strtotime($work->start_date)) }}"   
                            name="start_date">
                    @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date" class="form-control dateform" 
                            style="width: 300px"
                            value="{{old('time')?? date('Y-m-d', strtotime($work->end_date)) }}" 
                             name="end_date">
                    @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <select name="check" class="form-control">
                        <option value="1">Xác nhận</option>
                        <option value="0">Không xác nhận</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('check.list')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>

 
@endsection
