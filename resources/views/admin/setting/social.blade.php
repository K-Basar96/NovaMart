<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body d-flex flex-column">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="background-color: #FF9933;">
                        <div class="form-floating">
                            <input type="text" required placeholder="social_name1"
                                class="form-control @error('social_name1') is-invalid @enderror" id="social_name1"
                                name="social_name1" value="{{ old('social_name1') }}">
                            <label for="social_name1">Social Network Name</label>
                            @error('social_name1')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" required placeholder="social_link1"
                                class="form-control @error('social_link1') is-invalid @enderror" id="social_link1"
                                name="social_link1" value="{{ old('social_link1') }}">
                            <label for="social_link1">Social Network Link</label>
                            @error('social_link1')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body" style="background-color: #FFFFFF;">
                        <div class="form-floating">
                            <input type="text" required placeholder="social_name2"
                                class="form-control @error('social_name2') is-invalid @enderror" id="social_name2"
                                name="social_name2" value="{{ old('social_name2') }}">
                            <label for="social_name2">Social Network Name</label>
                            @error('social_name2')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="social_link2"
                                class="form-control @error('social_link2') is-invalid @enderror" id="social_link2"
                                name="social_link2" value="{{ old('social_link2') }}">
                            <label for="social_link2">Social Network Link</label>
                            @error('social_link2')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body" style="background-color: #138808;">
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="social_name3"
                                class="form-control @error('social_name3') is-invalid @enderror" id="social_name3"
                                name="social_name3" value="{{ old('social_name3') }}">
                            <label for="social_name3">Social Network Name</label>
                            @error('social_name3')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" required placeholder="social_link3"
                                class="form-control @error('social_link3') is-invalid @enderror" id="social_link3"
                                name="social_link3" value="{{ old('social_link3') }}">
                            <label for="social_link3">Social Network Link</label>
                            @error('social_link3')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-1">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
