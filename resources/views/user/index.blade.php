@extends('layouts/layoutMaster')
@section('title', 'eCommerce Customer All - Apps')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('content')
    <!-- customers List Table -->
    <div class="card">
        @can('user_access')
            <div class="card-datatable table-responsive">
                <table class="datatables-customers table border-top">
                    <thead>
                        <tr>
                            <th class="text-center">NAME ID</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a class="px-1" href="{{route('user.edit', ['id' => $user->id])}}">Edit</a>
                                    <a class="px-1 text-danger hover:underline" href="javascript:void(0);"
                                        onclick="deleteLead({{ $user->id }})">Delete</a>
                                    <form id="user{{$user->id}}" action="{{ route('user.delete', ['id' => $user->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endcan
        <script>
            function deleteLead(userId) {
                if (confirm("Bạn có chắc chắn xóa không?") == true) {
                    document.getElementById('user' + userId).submit();
                }
            }
        </script>
@endsection