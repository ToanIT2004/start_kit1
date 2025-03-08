@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('content')
  <table class="table mb-0">
    <thead class="table-dark">
    <tr class="text-center">
      <th>Vai trò</th>
      <th>Mô tả</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($permissions as $permission)
    <tr class="text-center">
      <td><span class="badge bg-label-primary me-1">{{ $permission->title }}</span></td>
      <td>
      @if ($permission->title === 'user_access')
      Chức năng người dùng
    @endif
      @if ($permission->title === 'user_create')
      Chức năng tạo người dùng
    @endif
      @if ($permission->title === 'user_edit')
      Chức năng sửa người dùng
    @endif
      @if ($permission->title === 'user_delete')
      Xóa người dùng
    @endif

      </td>
      <td>
      <div class="dropdown">
      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
        class="icon-base ti tabler-dots-vertical"></i></button>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i>Edit</a>
      <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i>Delete</a>
      </div>
      </div>
      </td>
    </tr>
  @endforeach


    </tbody>
  </table>
@endsection