@extends('admin.layout.master')
@section('page-name','Registered Users')

@section('admin-content')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="mb-4 text-center">Users List</h1>
    <a href="{{route('user.create')}}" class="btn btn-outline-primary mb-3">Add User</a>
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
                        <td><img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" height="100px" width="100px"></td>
                        <td>{{ $user->role }}</td>
                        
                        <td>
                            <a href="{{ route('product.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
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