@extends('admin.layout.master')
@section('page-name','Edit Category')
@section('admin-content')
<div class="container py-5">
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Edit Category</h3>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="mt-4 d-flex justify-content-center">
                    <img id="previewImage" src="{{ asset('storage/' . $category->image) }}" alt="category Image" class="img-fluid" style="width: 200px; height: 140px;">
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2 d-flex justify-content-center">
                            <label for="image" class="btn btn-outline-primary btn-sm">Change Image</label>
                            <input type="file" name="image" id="image" style="display:none;" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$category->name) }}" >
                            <label for="name" class="form-label">Category Name</label>
                            @error('name') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description',$category->description) }}" >
                            <label for="description" class="form-label">Description</label>
                            @error('description') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection