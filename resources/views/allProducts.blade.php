@extends('user.layout.master')
@section('title','All Products')
@section('content')
@include('user.layout.filter')
    <section class="all-products py-5" id="products">
        <div class="container">
            <h2 class="text-center mb-4">All Products</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        @php
                            $products = [
                                [
                                    'title' => 'Wireless Earbuds',
                                    'price' => '$49.99',
                                ],
                                [
                                    'title' => 'Smart Watch',
                                    'price' => '$39.99',
                                ],
                                [
                                    'title' => 'Bluetooth Speaker',
                                    'price' => '$59.99',
                                ],
                                [
                                    'title' => 'Power Bank',
                                    'price' => '$29.99',
                                ],
                                [
                                    'title' => 'Bluetooth Speaker',
                                    'price' => '$59.99',
                                ],
                                [
                                    'title' => 'Power Bank',
                                    'price' => '$29.99',
                                ],
                                
                                [
                                    'title' => 'Wireless Earbuds',
                                    'price' => '$49.99',
                                ],
                                [
                                    'title' => 'Smart Watch',
                                    'price' => '$39.99',
                                ],
                                
                            ];
                        @endphp
                        @foreach ($products as $product)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset('images/'.$product['title']) }}.png" class="card-img-top" alt="{{ $product['title'] }}">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $product['title'] }}</h3>
                                        <p class="card-text">{{ $product['price'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection