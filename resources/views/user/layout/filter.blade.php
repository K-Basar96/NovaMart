<!-- Filter Bar -->
<div class="mb-2">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-1">
                    <h3 class="fw-bold">Filters</h3>
                </div>
                <form action="{{ route('product.filter') }}" method="POST" style="display: contents">
                    @csrf
                    <!-- Brand Dropdown -->
                    <div class="col-md-2">
                        <select name="brand" class="form-select" aria-label="Brand filter">
                            <option hidden selected value="">Choose Brand</option>
                            @forelse ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @empty
                                <option value="" disabled>No Brands found</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-md-2">
                        <select name="category" class="form-select" aria-label="Category filter">
                            <option hidden selected value="">Choose Category</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="" disabled>No Category found</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Price Range bar -->
                    <div class="col-md-3">
                        <label class="form-label">Select Price Range:</label>
                        <div class="range_container">
                            <div class="form_control">
                                <div class="control_container d-flex align-items-center gap-2">
                                    <div class="input-group" style="width: 45%;">
                                        <span class="input-group-text">Min</span>
                                        <input type="number" name="min_price" class="form-control" value=""
                                            placeholder="Min">
                                    </div>
                                    <span class="text-muted">-</span>
                                    <div class="input-group" style="width: 45%;">
                                        <span class="input-group-text">Max</span>
                                        <input type="number" name="max_price" class="form-control" value=""
                                            placeholder="Max">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-1 d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary apply-filter flex-grow-1">Apply Filters</button>
                    </div>
                </form>

                <div class="col-md-1 d-flex flex-column gap-2">
                    <a href="{{ route('product.index') }}"
                        class="btn btn-outline-secondary clear-filter flex-grow-1">Clear</a>
                </div>
                <div class="col-md-2">
                    <h3 class="fw-bold mb-1">Sort by</h3>
                    <div class="col-md">
                        <select class="form-select" onchange="redirectToAllProducts(this.value)">
                            <option hidden selected>Sort By</option>
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="low_to_high">Price: Low to High</option>
                            <option value="high_to_low">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function redirectToAllProducts(sortOption) {
        window.location.href = "{{ route('product.sortby', '') }}/" + sortOption;
    }
</script>
