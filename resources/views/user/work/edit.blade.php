@extends('user.master.master')
@section('title','Chỉnh sửa công việc')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa công việc</h1>
            <hr>
            <form
                method="post"
                action="{{ route('work.update')}}">
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
                    @if ($work->end_date == null)
                    <input type="date" class="form-control dateform" 
                    style="width: 300px"
                     name="end_date">
                    @else
                    <input type="date" class="form-control dateform" 
                            style="width: 300px"
                            value="{{old('time')?? date('Y-m-d', strtotime($work->end_date)) }}" 
                             name="end_date">
                    @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="Chưa hoàn thành">chưa hoàn thành</option>
                        <option value="Hoàn thành">Hoàn thành</option>
                        <option value="Tạm dừng">Tạm dừng</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number"  value = 0
                           class="form-control " name="check"
                           style="display: none">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('work.index')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>

 
@endsection
