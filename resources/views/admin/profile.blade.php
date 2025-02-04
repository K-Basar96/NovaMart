@extends('admin.layout.master')
@section('page-name','Admin Profile')
@section('admin-content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <h2 class="text-center mb-4">Edit Profile</h2>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4 text-center mt-5">
                            <img id="previewImage" src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="rounded-circle" style="width: 160px; height: 180px;">
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('admin.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }} </div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }} </div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" minlength="10" maxlength="10" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="m-2 float-start position-relative" style="left: -170px">
                                    <label for="image" class="btn btn-outline-primary">Change Image</label>
                                    <input type="file" name="image" id="image" style="display:none;" accept="image/*" onchange="previewImage(event)">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">Update</button>
                            </form>
                        </div>
                    </div>
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