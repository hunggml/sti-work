@extends('user.master.master')
@section('title', 'Danh sách phòng ban')
@section('content')
<style>
    input{
        border: none !important;
    }
    </style>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách phòng ban</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <a style="color: white" class="btn btn-primary mb-2" href={{ route('group.create') }}>
                            Thêm phòng ban
                        </a>
                        {{-- <a data-toggle="modal" data-target="#exampleModal" aria-labelledby="dropdownMenuLink"
                            class="btn btn-warning" style="float: right;color:black">
                            Import Excel
                        </a> --}}
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Phòng ban</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $key => $group)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td><a class="btn btn-success edit"
                                                href="{{ route('group.edit', ['id' => $group->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Chỉnh sửa phòng ban
                                            </a>
                                        </td>
                                        <td>
                                            @if ($group->id != 1)
                                                <a href="{{ route('group.destroy', ['id' => $group->id]) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                    <i class="far fa-trash-alt"></i>
                                                    Xoá phòng ban
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{-- modal import excel --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="{{ route('import.Group') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="import" class="form-control" required>
                        </div>
                        @error('import')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
