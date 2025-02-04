@extends('admin.layout.master')
@section('page-name','Dashboard')
@section('admin-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <a class="card bg-primary text-white mb-4 text-decoration-none" href="{{route('admin.users')}}">
                <h4 class="card-body text-uppercase">users</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h3>{{$users}}</h3>
                    <div class="small text-white"><h3 class="bi bi-people"></h3></div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a class="card bg-primary text-white mb-4 text-decoration-none" href="{{route('admin.products')}}">
                <h4 class="card-body text-uppercase">products</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h3>{{$products}}</h3>
                    <div class="small text-white"><h3 class="bi bi-box-seam"></h3></div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
