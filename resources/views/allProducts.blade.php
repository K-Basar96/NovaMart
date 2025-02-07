@extends('user.layout.master')
@section('title', 'All Products')
@section('content')
    @include('user.layout.filter')
    <h1 class="text-center mb-4">All Products</h1>

    <section class="all-products py-5" id="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-2">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card h-100 d-flex flex-column" data-brand="{{ $product->brand }}"
                                    data-category="{{ $product->category }}" data-price="{{ $product->price }}"
                                    data-name="{{ $product->name }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}" width="100" height="200">
                                    <!-- Wishlist Icon (Love Icon) -->
                                    @php
                                        $inWishlist =
                                            auth()->check() &&
                                            auth()->user()->wishlists->contains('product_id', $product->id);
                                    @endphp
                                    <form action="{{ route('wishlist.toggle') }}" method="POST"
                                        style="position: absolute; top: 10px; right: 10px;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit"
                                            class="btn wishlist-icon {{ $inWishlist ? 'text-danger' : 'text-muted' }} rounded-circle border-0 p-2"
                                            id="wishlist-icon-{{ $product->id }}"
                                            style="background-color: rgba(255, 255, 255, 0.5);">
                                            <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"
                                                style="font-size: 1.5rem;"></i>
                                        </button>
                                    </form>
                                    <div class="card-body d-flex flex-column">
                                        <h4 class="card-title">{{ $product->name }}</h4>
                                        <p class="card-text">{{ $product->price }}</p>
                                        <div class="d-flex flex-column align-items-center w-100 mt-auto">
                                            <div class="w-100 mb-2">
                                                <form action="{{ route('cart.store') }}" method="POST"
                                                    class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1" min="1">
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </form>
                                            </div>
                                            <div class="success-message"
                                                style="display: none; color: green; margin-top: 10px; text-align: center;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('user.layout.addtoCart')
    <script>
        $(document).ready(function() {
            function filterProducts() {
                var selectedBrand = $('select[aria-label="Brand filter"]').val();
                var selectedCategory = $('select[aria-label="Category filter"]').val();
                var minPrice = parseFloat($('#minPriceInput').val());
                var maxPrice = parseFloat($('#maxPriceInput').val());
                var searchTerm = $('input[name="search"]').val().toLowerCase();

                $('.card').each(function() {
                    var productBrand = $(this).data('brand').toLowerCase();
                    var productCategory = $(this).data('category').toLowerCase();
                    var productPrice = parseFloat($(this).data('price'));
                    var productName = $(this).data('name').toLowerCase();

                    var brandMatch = selectedBrand === "Choose Brand" || productBrand === selectedBrand
                        .toLowerCase();
                    var categoryMatch = selectedCategory === "Choose Category" || productCategory ===
                        selectedCategory.toLowerCase();
                    var priceMatch = (isNaN(minPrice) || productPrice >= minPrice) && (isNaN(maxPrice) ||
                        productPrice <= maxPrice);
                    var searchMatch = productName.includes(searchTerm);

                    if (brandMatch && categoryMatch && priceMatch && searchMatch) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            function sortProducts() {
                var sortBy = $('select[aria-label="Sort by"]').val();
                var $products = $('.card');
                var $container = $('.row-cols-1');

                $products.sort(function(a, b) {
                    var priceA = parseFloat($(a).data('price'));
                    var priceB = parseFloat($(b).data('price'));

                    if (sortBy === "price-low") {
                        return priceA - priceB; // Price: Low to High
                    } else if (sortBy === "price-high") {
                        return priceB - priceA; // Price: High to Low
                    }
                });

                $container.html($products);
            }

            // Apply Filters Button
            $('.apply-filter').on('click', function() {
                filterProducts();
            });

            // Clear Filters Button
            $('.clear-filter').on('click', function() {
                $('select[aria-label="Brand filter"]').val("Choose Brand");
                $('select[aria-label="Category filter"]').val("Choose Category");
                $('#minPriceInput').val(0);
                $('#maxPriceInput').val(1000);
                $('input[name="search"]').val('');
                $('.card').show(); // Show all products
            });

            // Search Form Submission
            $('form[role="search"]').on('submit', function(e) {
                e.preventDefault();
                filterProducts();
            });

            // Sort Products Dropdown
            $('select[aria-label="Sort by"]').on('change', function() {
                sortProducts();
            });
        });
    </script>
@endsection
