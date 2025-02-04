@extends('admin.layout.master')
@section('page-name','Add Product')
@section('admin-content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Add Category</h3>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="image" class="form-label">Category image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
                            <label for="name" class="form-label">Category Name</label>
                            @error('name') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" >
                            <label for="description" class="form-label">Description</label>
                            @error('description') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-2">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection