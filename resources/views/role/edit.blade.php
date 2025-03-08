@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
   @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
   @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('content')
   <h1>Cập nhật vai trò người dùng</h1>
   <div class="container mt-5">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('role.update', ['id' => $role->id]) }}" method="POST">
            @csrf()
            @method('PUT')
            <div class="mb-3">
               <label class="form-label fs-4">Vai trò</label>
               <input type="text" name="title" class="form-control" value="{{ $role->title }}" readonly />
            </div>

            <div class="mb-3">
               <label class="form-label fs-4">Permissions: </label>
               <div class="row">
                 @foreach ($permissions as $permission)
                <div class="col-md-3">
                  <input type="checkbox" id="perm{{ $permission->id }}" name="permissions[]"
                   value="{{ $permission->id }}" {{ in_array($permission->id, $permissions_role->toArray()) ? 'checked' : '' }}>
                  <label for="perm1">{{ $permission->title }}</label>
                </div>
             @endforeach

               </div>

               <div class="mt-5">
                 <div class="d-flex justify-content-end">
                   <button type="submit" class="btn btn-primary">Save</button>

                 </div>
               </div>
          </form>
        </div>
      </div>
   </div>
@endsection