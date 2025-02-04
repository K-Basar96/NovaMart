@extends('admin.layout.master')
@section('page-name','Add Brand')
@section('admin-content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Add Brand</h3>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
                            <label for="name" class="form-label">Brand Name</label>
                            @error('name') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="logo" class="form-label">Brand Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                            @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Add Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection