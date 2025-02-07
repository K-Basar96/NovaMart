<!-- Filter Bar -->
<div class="mb-2">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-1">
                    <h3 class="fw-bold">Filters</h3>
                </div>
                <!-- Brand Dropdown -->
                <div class="col-md-2">
                    <select class="form-select" aria-label="Brand filter">
                        <option hidden selected>Choose Brand</option>
                        @forelse ($brands as $brand)
                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                        @empty
                            <option value="" disabled>No Brands found</option>
                        @endforelse
                    </select>
                </div>

                <!-- Category Dropdown -->
                <div class="col-md-2">
                    <select class="form-select" aria-label="Category filter">
                        <option hidden selected>Choose Category</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
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
                                    <input type="number" id="minPriceInput" class="form-control" value="0"
                                        placeholder="Min">
                                </div>
                                <span class="text-muted">-</span>
                                <div class="input-group" style="width: 45%;">
                                    <span class="input-group-text">Max</span>
                                    <input type="number" id="maxPriceInput" class="form-control" value="1000"
                                        placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="col-md-2 d-flex flex-column gap-2">
                    <button type="button" class="btn btn-primary apply-filter flex-grow-1">Apply Filters</button>
                    <button type="button" class="btn btn-outline-secondary clear-filter flex-grow-1">Clear</button>
                </div>
                <div class="col-md-2">
                    <h3 class="fw-bold mb-1">Sort by</h3>
                    <div class="col-md">
                        <select class="form-select">
                            <option hidden selected>Sort By</option>
                            <option value="price">Newest First</option>
                            <option value="price">Oldest First</option>
                            <option value="price">Price: Low to High</option>
                            <option value="apple">Price: High to low</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
