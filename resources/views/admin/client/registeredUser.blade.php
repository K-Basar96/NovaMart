@extends('admin.layout.master')
@section('page-name', 'Registered Users')

@section('admin-content')

    <div class="container mt-5">
        @include('alert')
        <h1 class="mb-4 text-center">Users List</h1>
        <a href="{{ route('user.create') }}" class="btn btn-outline-primary mb-3">Add User</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <tr class="table-primary">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td><img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" height="100px"
                                    width="100px"></td>
                            <td>
                                {{ $user->role }}
                                @if ($user->id == 1)
                                    <i class="bi bi-person-fill-lock text-primary fs-5"></i>
                                @else
                                    <a href="{{ route('admin.switch', $user->id) }}" class="bi bi-repeat"></a>
                                    {{-- Switch icon for others --}}
                                @endif
                            </td>
                            <td class="d-flex flex-column gap-1">
                                <a href="{{ route('wishlist.show', $user->id) }}"
                                    class="bi bi-heart-fill btn btn-sm btn-warning"> Wishlist</a>
                                <a href="{{ route('cart.show', $user->id) }}"
                                    class="bi bi-cart-fill btn btn-sm btn-warning">
                                    Cart</a>
                                <a href="{{ route('users.order', $user->id) }}" class="bi bi-cart4 btn btn-sm btn-warning">
                                    Orders</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
