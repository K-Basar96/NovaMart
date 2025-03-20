<!-- Filter Bar -->
<div class="mb-2">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.filter') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <!-- Filters Title -->
                    <div class="col-12">
                        <h3 class="fw-bold">Filters</h3>
                    </div>

                    <!-- Brand Dropdown -->
                    <div class="col-12 col-md-2">
                        <div class="dropdown w-100">
                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                id="brandDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ !empty($filters['brand']) ? 'Selected Brand' : 'Choose Brand' }}
                            </button>
                            <ul class="dropdown-menu p-2 w-100" aria-labelledby="brandDropdown"
                                style="max-height: 200px; overflow-y: auto;">
                                @forelse ($brands as $brand)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="brand[]"
                                                value="{{ $brand->id }}" id="brand{{ $brand->id }}"
                                                {{ isset($filters['brand']) && in_array($brand->id, $filters['brand']) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="brand{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    </li>
                                @empty
                                    <li class="dropdown-item text-muted">No Brands found</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-12 col-md-2">
                        <div class="dropdown w-100">
                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ !empty($filters['category']) ? 'Selected Category' : 'Choose Category' }}
                            </button>
                            <ul class="dropdown-menu p-2 w-100" aria-labelledby="categoryDropdown"
                                style="max-height: 200px; overflow-y: auto;">
                                @forelse ($categories as $category)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category[]"
                                                value="{{ $category->id }}" id="category{{ $category->id }}"
                                                {{ isset($filters['category']) && in_array($category->id, $filters['category']) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    </li>
                                @empty
                                    <li class="dropdown-item text-muted">No Categories found</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="col-12 col-md-3">
                        <div class="d-flex gap-2">
                            <div class="form-floating w-50">
                                <input type="number" name="min_price" class="form-control" id="minPrice"
                                    value="{{ $filters['min_price'] ?? '' }}" placeholder="Min Price">
                                <label for="minPrice">Min Price</label>
                            </div>
                            <div class="form-floating w-50">
                                <input type="number" name="max_price" class="form-control" id="maxPrice"
                                    value="{{ $filters['max_price'] ?? '' }}" placeholder="Max Price">
                                <label for="maxPrice">Max Price</label>
                            </div>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <div class="col-12 col-md-1">
                        <button type="submit" class="btn btn-primary w-100">Apply</button>
                    </div>

                    <!-- Clear Button -->
                    <div class="col-12 col-md-1">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
                    </div>

                    <!-- Sort by -->
                    <div class="col-12 col-md-3 d-flex justify-content-center align-items-center gap-2">
                        <h5 class="fw-bold mb-0">Sort by:</h5>
                        <select class="form-select flex-grow-1 w-auto" style="min-width: 150px; max-width: 200px;"
                            onchange="redirectToAllProducts(this.value)">
                            <option hidden selected>Sort By</option>
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="low_to_high">Price: Low to High</option>
                            <option value="high_to_low">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function redirectToAllProducts(sortOption) {
        window.location.href = "{{ route('product.sortby', '') }}/" + sortOption;
    }
</script>
