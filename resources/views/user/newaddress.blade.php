@extends('user.layout.master')
@section('title', 'Saved Addressess')
@section('content')
    <style>
        .custom-tooltip {
            --bs-tooltip-bg: ;
            --bs-tooltip-color: #555555;
        }
    </style>
    <div class="container my-3 justify-content-centre">
        <div class="row justify-content-center">
            <h1 class="mb-4">Add New Address</h1>
            <form action="{{ route('address.store') }}" method="POST">
                @csrf
                <div class="container col-6">
                    <div class="form-floating mb-3">
                        <input type="text" required placeholder="recipient"
                            class="form-control @error('recipient') is-invalid @enderror" id="recipient" name="recipient"
                            value="{{ old('recipient') }}">
                        <label for="recipient" class="form-label">Recipient</label>
                        @error('recipient')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required placeholder="recipient_number"
                            class="form-control @error('recipient_number') is-invalid @enderror" id="recipient_number"
                            name="recipient_number" value="{{ old('recipient_number') }}">
                        <label for="recipient_number" class="form-label">Recipient Number</label>
                        @error('recipient_number')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" required placeholder="street"
                            class="form-control @error('street') is-invalid @enderror" id="street" name="street"
                            value="{{ old('street') }}">
                        <label for="street" class="form-label">Street</label>
                        @error('street')
                            <div class="invalid-feedback">{{ $message }} </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-floating mb-3 w-100 me-2">
                            <input type="text" required placeholder="city"
                                class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                                value="{{ old('city') }}">
                            <label for="city" class="form-label">City</label>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3 w-100">
                            <input type="text" required placeholder="state"
                                class="form-control @error('state') is-invalid @enderror" id="state" name="state"
                                value="{{ old('state') }}">
                            <label for="state" class="form-label">State</label>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-floating mb-3 w-100 me-2">
                            <input type="text" required placeholder="country"
                                class="form-control @error('country') is-invalid @enderror" id="country" name="country"
                                value="{{ old('country') }}">
                            <label for="country" class="form-label">Country</label>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3 w-100">
                            <input type="text" required placeholder="zip_code"
                                class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code"
                                value="{{ old('zip_code') }}">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            @error('zip_code')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="mb-3 w-100 me-2">
                            <label for="exact_locale" class="ms-2 form-label">
                                Exact Locale&nbsp;
                                <i class="bi bi-patch-question" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-custom-class="custom-tooltip"
                                    data-bs-title='<img src="{{ asset('images/google-plus-code.jpg') }}" 
                                    alt="Steps to find Google Maps Plus Code:
                                    1. Launch the Google Maps app on your device.
                                    2. Enter the address or tap on the location where the red pin will drop.
                                    3. A card will appear; swipe up. The Plus Code will be listed under the address or coordinates.">'>
                                </i>
                            </label>
                            <input type="text" maxlength="8" id="exact_locale" name="exact_locale"
                                class="form-control @error('exact_locale') is-invalid @enderror"
                                placeholder="Google map plus code (e.g: 52GR+3V)" required
                                value="{{ old('exact_locale') }}">
                            @error('exact_locale')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 w-100">
                            <label for="address_type" class="form-label">Address Type <span
                                    class="text-secondary small">(e.g: Home, Work, Others)</span></label>
                            <input type="text" required placeholder="Type of Address"
                                class="form-control @error('address_type') is-invalid @enderror" id="address_type"
                                name="address_type" value="{{ old('address_type') }}">
                            @error('address_type')
                                <div class="invalid-feedback">{{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class=" mb-3">
                        <input type="checkbox" class="form-check-input" id="is_default" name="is_default">
                        <label for="is_default" class="form-check-label">Set as Default Address</label>
                    </div>
                    <button id="save_address" type="submit" class="btn btn-primary mt-3">Save Address</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip({
                html: true
            });

            function checkInput() {
                const value = $('#exact_locale').val().toUpperCase();
                $('#exact_locale').val(value);
                // Regex to check the value
                const regex = /^[A-Z0-9]{4}\+[A-Z0-9]{2}$/;
                $('#save_address').prop('disabled', !regex.test(value)); // Enable or disable button
            }
            $('#exact_locale').on('keyup input', checkInput); // Listen for both keyup and input events
        });
    </script>
@endsection
