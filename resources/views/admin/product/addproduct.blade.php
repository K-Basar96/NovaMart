@extends('admin.layout.master')
@section('page-name', 'Add Product')
@section('admin-content')
    <div class="container py-5">
        @include('alert')
        <div class="row justify-content-center">
            <h3 class="text-center mb-4">Add Product</h3>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="description" class="form-label">Product Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" value="{{ old('description') }}">
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                            <div class=" d-flex mb-2 justify-content-between">
                                <div>
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" minlength="10" maxlength="10"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="stock" class="form-label">Stock Quantity</label>
                                    <input type="number" minlength="10" maxlength="10"
                                        class="form-control @error('stock') is-invalid @enderror" id="stock"
                                        name="stock" value="{{ old('stock') }}">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=" d-flex mb-2 justify-content-between">
                                <div>
                                    <label for="category" class="form-label">Select Category</label>
                                    <select name="category_id" id="category" class="form-select">
                                        <option value="" hidden selected>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="brand" class="form-label">Select Brand</label>
                                    <select name="brand_id" id="brand" class="form-select">
                                        <option value="" hidden selected>Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">Product Picture</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
