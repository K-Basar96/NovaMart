@extends('admin.layout.master')
@section('page-name','Add Slider')
@section('admin-content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Add Slider</h3>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" required class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" data-bs-toggle="tooltip" title="Upload an image (25:9 aspect ratio)">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" placeholder="heading" value="{{ old('heading') }}" >
                            @error('heading') <div class="invalid-feedback">{{ $message }} </div>@enderror
                            <label for="heading">Heading</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="content" value="{{ old('content') }}" >
                            @error('content') <div class="invalid-feedback">{{ $message }} </div>@enderror
                            <label for="content">Content</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" placeholder="button_text" value="{{ old('button_text') }}" >
                            @error('button_text') <div class="invalid-feedback">{{ $message }} </div>@enderror
                            <label for="button_text">Button Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" required class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" placeholder="button_url" value="{{ old('button_url') }}" >
                            @error('button_url') <div class="invalid-feedback">{{ $message }} </div>@enderror
                            <label for="button_url">Button url</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select required class="form-select @error('position') is-invalid @enderror" id="position" name="position">
                                <option value="" hidden>Select Position</option>
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                            @error('position') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="position">Position</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Add Slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const image = document.getElementById('previewImage');
        image.src = URL.createObjectURL(event.target.files[0]); 
    }
</script>
@endsection