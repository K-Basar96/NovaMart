<div class="col-md-4">
    <h2 class="text-center mb-4">Change Password</h2>
    <div class="card shadow">
        <div class="card-body p-4 text-center">
            <div class="col">
                <form action="{{ route('password.change') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                            name="old_password" placeholder="Old Password" required>
                        <label for="old_password" class="form-label">Old Password</label>
                        @error('old_password')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="New Password" required>
                        <label for="password" class="form-label">New Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('confirm_password') is-invalid @enderror"
                            name="confirm_password" placeholder="Confirm Password" required>
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        @error('confirm_password')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
