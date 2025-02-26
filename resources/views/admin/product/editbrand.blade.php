@extends('admin.layout.master')
@section('page-name', 'Edit brand')
@section('admin-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <h3 class="text-center mb-4">Edit brand</h3>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="mt-4 d-flex justify-content-center">
                        <img id="previewImage" src="{{ asset('storage/' . $brand->logo) }}" alt="brand Image" class="img-fluid"
                            style="width: 200px; height: 140px;">
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-2 d-flex justify-content-center">
                                <label for="logo" class="btn btn-outline-primary btn-sm">Change logo</label>
                                <input type="file" name="logo" id="logo" style="display:none;" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $brand->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Update brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
