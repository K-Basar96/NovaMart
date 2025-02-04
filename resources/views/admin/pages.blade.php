@extends('admin.layout.master')
@section('page-name','Manage Pages')

@section('admin-content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<h1> Pages</h1>
</div>
@endsection