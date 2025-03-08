@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{route('role.create')}}" class="text-white btn-primary btn mb-5">Thêm vai trò</a>
        </div>
        <table class="table mb-0">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Vai trò</th>
                    <th>Mô tả</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr class="text-center">
                        <td><span class="badge bg-label-primary me-1">{{$role->title}}</span></td>
                        <td>Người dùng</td>
                        <td>
                            <div class="">
                                <a class="px-1" href="{{ route('role.edit', ['id' => $role->id]) }}">Edit</a>
                                <a class="px-1 text-danger" href="{{ route('role.delete', ['id' => $role->id]) }}">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection