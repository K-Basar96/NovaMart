<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="login-container rounded-4 shadow " id="login-container">
                    <h1 class="mb-4 fs-2 text-center">Login</h1>
                    <form action="{{route('login')}}" method="POST" class="p-3 p-md-3">
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
                        <button type="submit" class="btn btn-outline-primary w-100 mb-3">Login</button>
                    </form>
                    <p class="container text-center p-3 p-md-3">Don’t have an account?
                        <a href="{{route('user.create')}}" class="btn btn-outline-primary w-100">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>