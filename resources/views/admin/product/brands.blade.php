@extends('admin.layout.master')
@section('page-name', 'Brand Management')

@section('admin-content')

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 text-center">Brands</h1>
        <a href="{{ route('brand.create') }}" class="btn btn-outline-primary mb-3">Add brand</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <tr class="table-primary">
                    <th>Name</th>
                    <th>LOGO</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td><img src="{{ asset('storage/' . $brand->logo) }}" alt="brand Image" height="100px"
                                    width="100px"></td>
                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
