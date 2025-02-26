@include('user.layout.contact')


<div class="container mb-0">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-3">
        <div class="col">
            <h3>Shop</h3>
            <ul class="list-unstyled">
                <li><a href="#categories" class="text-white-50 text-decoration-none">Categories</a></li>
                <li><a href="#new" class="text-white-50 text-decoration-none">New Arrivals</a></li>
                <li><a href="#brands" class="text-white-50 text-decoration-none">Discover Brands</a></li>
            </ul>
        </div>
        <div class="col">
            <h3>Customer Service</h3>
            <ul class="list-unstyled">
                <li><a href="#" class="text-white-50 text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#contactModal">Contact Us</a></li>
                <li><a href="{{ route('faqs') }}" class="text-white-50 text-decoration-none">FAQs</a></li>
                <li><a href="{{ route('returnpolicy') }}" class="text-white-50 text-decoration-none">Returns</a></li>
            </ul>
        </div>
        <div class="col">
            <h3>Follow Us</h3>
            <ul class="list-unstyled">
                <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                        class="text-white-50 text-decoration-none">Facebook</a></li>
                <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"
                        class="text-white-50 text-decoration-none">Twitter</a></li>
                <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                        class="text-white-50 text-decoration-none">Instagram</a></li>
            </ul>
        </div>
    </div>
    <hr class="mt-4 mb-3">
    <p class="text-center mb-0">&copy; 2023 Online Shop. All rights reserved by Khairul Basar.</p>
</div>
