@extends('user.master.master')
@section('title', 'Danh sách phòng ban')
@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách phòng ban</h3>
                    </div>
                    <div class="card-body" id="car-body">
                        <a style="color: white" class="btn btn-primary mb-2" href={{ route('group.create') }}>Thêm phòng ban
                        </a>
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>STT</th>
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
                                            <a href="{{ route('group.destroy', ['id' => $group->id]) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc là muốn xoá không?')">
                                                <i class="far fa-trash-alt"></i>
                                                Xoá phòng ban
                                            </a>
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
@endsection