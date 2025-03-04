@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
   @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
   @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
   @vite('resources/assets/js/app-ecommerce-customer-all.js')
@endsection

@section('content')
   <h1>Sửa người dùng</h1>
   <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST" class="ecommerce-customer-add pt-0">
      @csrf()
      @method('PUT')
      <div class="ecommerce-customer-add-basic mb-4">
        <div class="mb-6">
          <label class="form-label" for="ecommerce-customer-add-name">Tên*</label>
          <input value="{{$user->name}}" type="text" class="form-control" id="name" placeholder="Điền tên của bạn..."
            name="name" />
          @error('name')
           <span class="text-red-500">{{$message}}</span>
        @enderror
        </div>
        <div class="mb-6">
          <label class="form-label" for="ecommerce-customer-add-email">Email*</label>
          <input value="{{$user->email}}" type="text" id="email" class="form-control" placeholder="Điền email của bạn..."
            name="email" />
          @error('email')
           <span class="text-red-500">{{$message}}</span>
        @enderror

        </div>

        <div>
          <button type="submit" class="btn btn-primary me-sm-4 data-submit">Update</button>
        </div>
   </form>
@endsection