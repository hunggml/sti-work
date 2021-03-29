@extends('master.master')
@section('title','Add Work')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Add Work</h1>
            <hr>
            <form action={{route('work.store')}} method="post">
                @csrf
                <div class="form-group">
                    <label>Work Detail</label>
                    <textarea type="text"
                              class="form-control @error('detail') border-danger @enderror" name="detail"
                              placeholder="Enter work detail ">{{old('detail')}}</textarea>
                    @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="datetime-local" value="{{old('start_date')}}"
                           class="form-control @error('start_date') border-danger @enderror" name="start_date"
                           placeholder="Enter start date">
                    @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="datetime-local" value="{{old('end_date')}}"
                           class="form-control @error('end_date') border-danger @enderror" name="end_date"
                           placeholder="Enter end date">
                    @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Hoàn thành">Hoàn thành</option>
                        <option value="Chưa hoàn thành">chưa hoàn thành</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="{{route('work.index')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
