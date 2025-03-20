<style>
    .left-section {
        position: sticky;
        top: 0;
        max-height: 95vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .right-section {
        min-height: 100vh;
        overflow-y: scroll;
    }
</style>

<div class="col-3 col-md-2 bg-light left-section" id="collapseExample">
    <div id="left-section" class="list-group">
        <div>
            <div class="card border-0" style="width: 17rem;">
                <div class="card-body">
                    <a href="#" class="nav-link">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    </a>
                </div>
            </div>
        </div>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.index') }}">
            <div><i class="bi bi-speedometer"></i></div>Dashboard
        </a>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.settings') }}">
            <div><i class="bi bi-gear"></i></div>Website Settings
        </a>

        <div class="accordion" id="accordionExample">
            <a class="collapsed nav-link btn btn-primary" data-bs-toggle="collapse" data-bs-target="#productManagement"
                aria-expanded="false" aria-controls="productManagement">
                <div><i class="bi-grid-fill"></i>
                </div>Product Management<i class="bi bi-caret-down position-relative"
                    style="top: -10px; right: -35px;"></i>
            </a>
            <div id="productManagement" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <a class=" nav-link btn btn-primary" href="{{ route('admin.products') }}">
                    <div><i class="bi-box-seam"></i></div>Products
                </a>
                <a class=" nav-link btn btn-primary" href="{{ route('admin.brands') }}">
                    <div><i class="bi bi-apple"></i></div>Brands
                </a>
                <a class=" nav-link btn btn-primary" href="{{ route('admin.categories') }}">
                    <div><i class="bi-list-ul"></i></div>Categories
                </a>
            </div>
        </div>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.orders') }}">
            <div><i class="bi bi-cart"></i></div>Order Management
        </a>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.sliders') }}">
            <div><i class="bi bi-images"></i></div>Manage Sliders
        </a>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.services') }}">
            <div><i class="bi bi-wrench"></i></div>Services
        </a>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.users') }}">
            <div><i class="bi bi-people"></i></div>Registered Users
        </a>
        <a class=" nav-link btn btn-primary" href="{{ route('admin.pages') }}">
            <div><i class="bi bi-file-earmark-text"></i></div>Page Settings
        </a>
        <div class="accordion" id="accordionExample">
            <a class="collapsed nav-link btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapsepages"
                aria-expanded="false" aria-controls="collapsepages">
                <div><i class="bi bi-book"></i>
                </div>Pages<i class="bi bi-caret-down position-relative" style="top: -10px; right: -35px;"></i>
            </a>
            <div id="collapsepages" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <a class=" nav-link btn btn-primary" href="#">
                    <div><i class="bi bi-file-earmark-text"></i></div>FAQ
                </a>
                <a class=" nav-link btn btn-primary" href="#">
                    <div><i class="bi bi-file-earmark-text"></i></div>Return Policy
                </a>
            </div>
        </div>
    </div>
</div>
