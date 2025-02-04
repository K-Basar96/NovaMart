@extends('admin.layout.master')
@section('page-name','Edit slider')
@section('admin-content')
<div class="container py-5">
    <div class="row justify-content-center">
        <h3 class="text-center mb-4">Edit slider</h3>
            <form class="col-md-8" action="{{ route('sliders.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card shadow d-flex flex-row">
                <div class="d-flex flex-column m-auto ms-3">
                    <img id="previewImage" src="{{ asset('storage/' . $slider->image) }}" alt="slider Image" class="img-fluid my-2" style="width: 260px; height: 130px;">
                    <label for="image" class="btn btn-outline-primary btn-sm">Change Image</label>
                    <input type="file" name="image" id="image" style="display:none;" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="card-body p-4">
                    <div class="form-floating mb-3">
                        <input type="text" required class="form-control @error('heading') is-invalid @enderror" id="heading" name="heading" placeholder="heading" value="{{ old('heading',$slider->heading) }}" >
                        @error('heading') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        <label for="heading">Heading</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="content" value="{{ old('content',$slider->content) }}" >
                        @error('content') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        <label for="content">Content</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" placeholder="button_text" value="{{ old('button_text',$slider->button_text) }}" >
                        @error('button_text') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        <label for="button_text">Button Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" placeholder="button_url" value="{{ old('button_url',$slider->button_url) }}" >
                        @error('button_url') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        <label for="button_url">Button url</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select required class="form-select @error('position') is-invalid @enderror" id="position" name="position">
                            <option value="" hidden>Select Position</option>
                            <option value="left" {{ $slider->position == 'left' ? 'selected' : '' }}>Left</option>
                            <option value="center" {{ $slider->position == 'center' ? 'selected' : '' }}>Center</option>
                            <option value="right" {{ $slider->position == 'right' ? 'selected' : '' }}>Right</option>
                        </select>
                        @error('position') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="position">Position</label>
                    </div>                    
                    <button type="submit" class="btn btn-primary w-100 mb-2">Update slider</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection