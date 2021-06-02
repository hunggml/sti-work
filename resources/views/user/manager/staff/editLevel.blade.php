@extends('user.master.master')
@section('title', 'Chỉnh sửa nhân viên')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h1>Chỉnh sửa nhân viên</h1>
            <hr>
            <form method="post"
                  action="{{route('staff.updateLevel',['id' => $user->id])}}"> 
                @csrf
                <div class="form-group">
                    <label>Nhân viên: </label>
                    <strong style="color: black;font-size:20px">{{$user->name}}</strong>
                </div>
                <div class="form-group" id="optionLevel">
                    <label>Cấp độ</label>
                    <select class="form-control select" name="level" id="select">
                            <option id="option1" value="1" {{$user->level == 1 ? 'selected' : ''}}>Quản lý</option>
                            <option id="option2" value="2" {{$user->level == 2 ? 'selected' : ''}}>Nhân viên</option>
                    </select>
                </div>
                <div class="form-group" id="group1">
                    <label>Phòng ban</label>                    
                    <select class="form-control" name="group_id"> 
                        @foreach($groups as $value)
                            <option value="{{$value->id}}" {{$user->group_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <?php $select = $user->group ?>
                <div class="form-group" style=" {{$user->level == 1 ? '' : 'display: none'}} " id="group2">
                    <label>Quản lý phòng ban</label>
                    <select class="duallistbox form-control" multiple="multiple" name="group[]">
                      @foreach($groups as $group)
                            <option value="{{$group->id}}" @if($select->contains('id',$group->id)) selected @endif>{{$group->name}}</option>
                      @endforeach
                    </select>
                  </div>
                
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a class="btn btn-danger" href="{{route('staff.stafflist')}}">Đóng</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
	<script>
        // $("#group2").hide();
         $("#select").on('input',function(){
             if($(this).val() == "1" ){
                $("#group2").show()
             }
             else{
                $("#group2").hide()
             }
         })

	</script>
@endpush
