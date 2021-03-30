@extends('master.master')
@section('title','Staff List')
@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Staff List</h3>
                                </div>
                                <div class="card-body "> 
                                    <a style="color: white" class="btn btn-primary mb-2 ml-2"
                                    href={{route('work.create')}}>Add
                                     Work</a>

                                     {{-- <button type="button" class="btn btn-primary mb-2 ml-2" data-toggle="modal" data-target="#addModal">
                                        Add Work
                                    </button> --}}
                                    <table id="example1" class="table table-bordered table-striped ">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Work detail</th>
                                                <th>Start-Date</th>
                                                <th>End-Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($work as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $value->detail }}</td>
                                                <td>{{ $value->start_date }}</td>
                                                <td>{{ $value->end_date }}</td>
                                                @if($value->status == 'Hoàn thành')
                                                    <td style="background-color: greenyellow;color:black">{{ $value->status }}</td>
                                                @else
                                                    <td style="background-color: #ff4a52;color: black">{{ $value->status }}</td>
                                                @endif
                                                <td><a class="btn btn-success edit"
                                                       href={{route('work.edit',['id'=>$value->id])}}>
                                                       <i class="far fa-edit"></i>
                                                    </a>
                                               
                                                    <a href="{{ route('work.destroy', ['id'=>$value->id]) }}"
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Are you sure you want to delete?')">
                                                       <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    {{-- Add work modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Work</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
                <div class="modal-body">
                    <div class="">
                        @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error )
                                        <li>{{$error}}</li>
                                @endforeach    
                            </ul>    
                        </div>
                        @endif
                        <form id="addWork" name="addWork" action={{route('work.store')}} method="post">
                            @csrf
                            <div class="form-group">
                                <label>Work Detail</label>
                                <textarea type="text"
                                        id="detail"
                                          class="form-control @error('detail') border-danger @enderror"  name="detail"
                                          placeholder="Enter work detail ">{{old('detail')}}</textarea>
                                @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="datetime-local" value="{{old('start_date')}}"
                                        id="start_date"
                                       class="form-control @error('start_date') border-danger @enderror" name="start_date"
                                       placeholder="Enter start date">
                                @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="datetime-local" value="{{old('end_date')}}"
                                        id="end_date"
                                       class="form-control @error('end_date') border-danger @enderror" name="end_date"
                                       placeholder="Enter end date">
                                @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Hoàn thành">Hoàn thành</option>
                                    <option value="Chưa hoàn thành">chưa hoàn thành</option>
                                </select>
                            </div>
            
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-danger" data-dismiss="modal" style="color: white">Cancel</a>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- edit --}}
<script type="text/javascript">
//   $(document).ready(function () {
//         $('#addWork').click(function (e) {
//             addWork();
//             e.preventDefault();
//         });
//             getAll();
//     });
//         $.ajax({
//             type: 'POST',
//             url: form_action,
//             data: $('#addWork').serialize(),
//             success: function (response) {
//                 console.log(response);
//                 $('#addWork')[0].reset();
//                 clear();
//                 $('#addModal').modal('hide');
//             },
//             error: function (data) {
// 			  }
            
//         });

</script>

@endsection
