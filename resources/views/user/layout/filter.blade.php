<!-- Filter Bar -->
<div class="container mb-4">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-1">
                    <h3 class="fw-bold">Filters</h3>
                </div>
                <!-- Brand Dropdown -->
                <div class="col-md-2">
                    <select class="form-select" aria-label="Brand filter">
                        <option selected>Choose Brand</option>
                        <option value="samsung">Samsung</option>
                        <option value="apple">Apple</option>
                        <option value="sony">Sony</option>
                    </select>
                </div>

                <!-- Category Dropdown -->
                <div class="col-md-2">
                    <select class="form-select" aria-label="Category filter">
                        <option selected>Choose Category</option>
                        <option value="electronics">Electronics</option>
                        <option value="accessories">Accessories</option>
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
                                    <input type="number" id="minPriceInput" class="form-control" value="0" placeholder="Min">
                                </div>
                                <span class="text-muted">-</span>
                                <div class="input-group" style="width: 45%;">
                                    <span class="input-group-text">Max</span>
                                    <input type="number" id="maxPriceInput" class="form-control" value="1000" placeholder="Max">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="col-md-2 d-flex flex-column gap-2">
                    <button class="btn btn-primary flex-grow-1">Apply Filters</button>
                    <button class="btn btn-outline-secondary flex-grow-1">Clear</button>
                </div>
                <div class="col-md-2">
                    <h3 class="fw-bold mb-1">Sort by</h3>
                    <div class="col-md">
                        <select class="form-select" aria-label="Brand filter">
                            <option selected>Choose Brand</option>
                            <option value="samsung">Samsung</option>
                            <option value="apple">Apple</option>
                            <option value="sony">Sony</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>