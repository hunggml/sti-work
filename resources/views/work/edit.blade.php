@extends('master.master')
@section('title','Edit Work')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Edit Work</h1>
            <hr>
            <form
                method="post"
                action="{{ route('work.update')}}">
                @csrf
                <div class="form-group">
                    <label>Work detail</label>
                    <textarea type="text" class="form-control" name="detail">{{$work->detail}}</textarea>
                    @error('detail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" style="display: none" readonly value="{{$work->id}}" name="id">
                </div>
                <div class="form-group">
                    <label>Start date</label>
                    <input type="datetime-local" class="form-control dateform" 
                            value="{{old('time')?? date('Y-m-d\TH:i', strtotime($work->start_date)) }}"   
                            name="start_date">
                    @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>End date</label>
                    <input type="datetime-local" class="form-control dateform" 
                            value="{{old('time')?? date('Y-m-d\TH:i', strtotime($work->end_date)) }}" 
                             name="end_date">
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
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger" href="{{route('work.index')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

 
@endsection
{{-- @push('script')
    <script>
        

        $('.dateform').daterangepicker(
            {
                singleDatePicker : true,
                timePicker :true,
                timePickerSeconds :true,
                timePicker24Hour:true,
                locate : {
                    format : 'Y-m-d\TH:i'
                }
            }
        )
</script>
@endpush --}}