@foreach (['success' => 'success', 'error' => 'danger'] as $key => $type)
    @if (session($key))
        <div class="alert alert-{{ $type }}">
            {{ session($key) }}
        </div>
    @endif
@endforeach
