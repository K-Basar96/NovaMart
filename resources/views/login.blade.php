@extends('user.layout.master')
@section('title', 'Login')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
                            @error('email') <div class="invalid-feedback">{{ $message }} </div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <a href="#" class="text-primary text-decoration-none small d-block mb-4">Forgot your password?</a>
                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    </form>
                    <div class="text-center">
                        <p class="container text-center p-3 p-md-3">Don’t have an account?
                            <a href="{{route('user.create')}}" class="btn btn-outline-primary w-100">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection