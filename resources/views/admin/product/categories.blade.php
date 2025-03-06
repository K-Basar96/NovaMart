@extends('admin.layout.master')
@section('page-name', 'Category Management')

@section('admin-content')

    <div class="container mt-5">
        @include('alert')
        <h1 class="mb-4 text-center">Categories</h1>
        <a href="{{ route('category.create') }}" class="btn btn-outline-primary mb-3">Add category</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <tr class="table-primary">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td><img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" height="100px"
                                    width="100px"></td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
