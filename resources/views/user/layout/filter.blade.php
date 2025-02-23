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
                    {{-- Brand Dropdown --}}
                    <div class="mx-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                id="brandDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ !empty($filters['brand']) ? 'Selected Brand' : 'Choose Brand' }}
                            </button>
                            <ul class="dropdown-menu p-2" aria-labelledby="brandDropdown"
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
                    <div class="mx-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ !empty($filters['category']) ? 'Selected Category' : 'Choose Category' }}
                            </button>
                            <ul class="dropdown-menu p-2" aria-labelledby="categoryDropdown"
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

                    <!-- Price Range bar -->
                    <div class="col-md-3 mx-3 text-center">
                        <div class="range_container">
                            <div class="form_control">
                                <div class="control_container d-flex align-items-center gap-2">
                                    <div class="form-floating" style="width: 45%;">
                                        <input type="number" name="min_price" class="form-control" id="minPrice"
                                            value="{{ $filters['min_price'] ?? '' }}" placeholder="Min Price">
                                        <label for="minPrice">Min Price</label>
                                    </div>
                                    <span class="text-muted">-</span>
                                    <div class="form-floating" style="width: 45%;">
                                        <input type="number" name="max_price" class="form-control" id="maxPrice"
                                            value="{{ $filters['max_price'] ?? '' }}" placeholder="Max Price">
                                        <label for="maxPrice">Max Price</label>
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
