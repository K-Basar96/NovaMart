@extends('user.layout.master')
@section('title', 'Profile edit')
@section('content')
    <div class="container py-5">
        @foreach (['success' => 'success', 'error' => 'danger'] as $key => $type)
            @if (session($key))
                <div class="alert alert-{{ $type }}">
                    {{ session($key) }}
                </div>
            @endif
        @endforeach
        <div class="row justify-content-around" style="align-items: center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Edit Profile</h2>
                <div class="card shadow">
                    <div class="card-body p-4 text-center">
                        <img id="previewImage" src="{{ asset('storage/' . $user->image) }}" alt="Profile Image"
                            class="img-fluid" style="width: 160px; height: 180px;">
                        <div class="col">
                            <form action="{{ route('user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="m-2">
                                    <label for="image" class="btn btn-outline-primary">Change Image</label>
                                    <input type="file" name="image" id="image" style="display:none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="name"
                                        value="{{ old('name', $user->name) }}" required>
                                    <label for="name" class="form-label">Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="email"
                                        value="{{ old('email', $user->email) }}" required>
                                    <label for="email" class="form-label">Email Address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" minlength="10" maxlength="10"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" placeholder="phone" value="{{ old('phone', $user->phone) }}"
                                        required>
                                    <label for="phone" class="form-label">Phone Number</label>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('user.layout.change_password')
        </div>
    </div>

    <script>
        function previewImage(event) {
            const image = document.getElementById('previewImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
