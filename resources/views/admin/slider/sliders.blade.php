@extends('admin.layout.master')
@section('page-name', 'Manage Sliders')

@section('admin-content')

    <div class="container mt-5">
        @include('alert')
        <h1 class="mb-4 text-center">sliders List</h1>
        <a href="{{ route('sliders.create') }}" class="btn btn-outline-primary mb-3">Add Slider</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered ">
                <tr class="table-primary">
                    <th>Image</th>
                    <th>Heading</th>
                    <th>Content</th>
                    <th>Button</th>
                    <th>URL</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @forelse($sliders as $slider)
                        <tr>
                            <td class="d-flex flex-column"><img src="{{ asset('storage/' . $slider->image) }}"
                                    alt="Profile Image" height="100"></td>
                            <td>{{ $slider->heading }}</td>
                            <td>{{ $slider->content }}</td>
                            <td>{{ $slider->button_text }}</td>
                            <td>{{ $slider->button_url }}</td>
                            <td>{{ $slider->position }}</td>

                            <td>
                                <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No sliders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
@endsection
