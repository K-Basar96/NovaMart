@extends('user.layout.master')
@section('title', 'Saved Addressess')
@section('content')
    <div class="container my-3 justify-content-centre">
        <div class="row">
            <h1 class="mb-4">Saved Addresses</h1>
            @include('alert')
            <div class="text-end">
                <a href="{{ route('address.create') }}" class="btn btn-primary mb-3">Add New Address</a>
            </div>
            @forelse ($addresses as $address)
                <div class="card col-5 m-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title d-flex">{{ $address->address_type }}
                                <span style="display: contents; font-size:small">
                                    {{ $address->is_default ? '(Default)' : '' }}</span>
                            </h4>
                            <div>
                                <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('address.destroy', $address->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p class="card-text">{{ $address->recipient }}</p>
                        <p class="card-text">{{ $address->recipient_number }}</p>
                        <p class="card-text">{{ $address->street }}</p>
                        <p class="card-text">{{ $address->city }}</p>
                        <p class="card-text">{{ $address->state }}</p>
                        <p class="card-text">{{ $address->country }}</p>
                        <p class="card-text">{{ $address->zip_code }}</p>
                        @php
                            $plusCode = $address->exact_locale;
                            $pin_location = '7MJC' . substr($plusCode, 0, 4) . '%2B' . substr($plusCode, 5);
                        @endphp
                        <a href="https://www.google.com/maps/place/{{ $pin_location }}/" target="_blank"
                            class="btn btn-secondary">Check Location&nbsp;<i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                </div>
            @empty
                <div>
                    <div class="text-center">No Saved addresses found</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
