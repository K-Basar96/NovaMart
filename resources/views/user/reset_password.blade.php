@extends('user.layout.master')
@section('title', 'Reset Password')
@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            @foreach (['success' => 'success', 'error' => 'danger'] as $key => $type)
                @if (session($key))
                    <div class="alert alert-{{ $type }}">
                        {{ session($key) }}
                    </div>
                @endif
            @endforeach
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Reset Password</h2>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">Reset Password</button>
                        </form>

                        <div class="text-center">
                            <p class="container text-center p-3 p-md-3">Remembered your password?
                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
