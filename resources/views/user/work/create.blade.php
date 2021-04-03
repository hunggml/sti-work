@extends('user.master.master')
@section('title','Thêm việc')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Thêm việc</h1>
            <hr>
            <form action={{route('work.store')}} method="post">
                @csrf
                <div class="form-group">
                    <label>Công Việc</label>
                    <textarea type="text"
                              class="form-control @error('detail') border-danger @enderror" name="detail"
                              placeholder="Nhập công việc cụ thể">{{old('detail')}}</textarea>
                    @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date"  value="{{old('start_date')}}"
                            style="width: 300px"
                           class="form-control @error('start_date') border-danger @enderror" name="start_date"
                           placeholder="Enter start date">
                    @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date"  value="{{old('end_date')}}"
                            style="width: 300px"
                           class="form-control @error('end_date') border-danger @enderror" name="end_date"
                           placeholder="Enter end date">
                    @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        {{-- <option value="Hoàn thành">Hoàn thành</option> --}}
                        <option value="Chưa hoàn thành">chưa hoàn thành</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number"  value = 0
                           class="form-control " name="check"
                           style="display: none">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Thêm việc</button>
                    <a class="btn btn-danger" href="{{route('work.index')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>

@endsection
