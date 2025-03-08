@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('content')
    <h1>Thêm người dùng</h1>
    <form action="{{ route('user.store') }}" method="POST" class="ecommerce-customer-add pt-0">
        @csrf()
        <div class="ecommerce-customer-add-basic mb-4">
            <div class="mb-6">
                <label class="form-label" for="ecommerce-customer-add-name">Tên*</label>
                <input type="text" class="form-control" id="name" placeholder="Điền tên của bạn..." name="name" />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="form-label" for="ecommerce-customer-add-email">Email*</label>
                <input type="text" id="email" class="form-control" placeholder="Điền email của bạn..."
                    name="email" />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="form-label" for="ecommerce-customer-add-email">Mật khẩu*</label>
                <input type="password" id="password" class="form-control" placeholder="Điền mật khẩu của bạn..."
                    name="password" />
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="form-label fs-4">Vai trò: </label>
                <div class="row">
                    @foreach ($roles as $role)
                        <div class="col-md-3">
                            <input type="radio" id="role{{ $role->id }}" name="role_id" value="{{ $role->id }}"
                                {{ $role->id == 2 ? 'checked' : '' }}>
                            <label for="role{{ $role->id }}">{{ $role->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary me-sm-4 data-submit">Add</button>
        </div>
    </form>
@endsection
