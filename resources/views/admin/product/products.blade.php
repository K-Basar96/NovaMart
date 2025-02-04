@extends('admin.layout.master')
@section('page-name','Product Management')

@section('admin-content')

<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="mb-4 text-center">Product List</h1>
    <a href="{{route('product.create')}}" class="btn btn-outline-primary mb-3">Add Product</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered ">
                <tr class="table-primary">
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" height="100px" width="100px"></td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{route('product.destroy',$product->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection