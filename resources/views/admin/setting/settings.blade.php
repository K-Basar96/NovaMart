@extends('admin.layout.master')
@section('page-name','Website Settings')
@section('admin-content')
<div class="container-fluid py-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- <h1>Settings</h1> --}}
    <div id="div">
        <ul>
            <li><a href="#Home">Home</a></li>
            <li><a href="#About">About</a></li>
            <li><a href="#Contact">Contact</a></li>
        </ul>
        <section id="Home">
            <h3>Home</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
        </section>
        <section id="About">
            <h3>About</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
        </section>
        <section id="Contact">
            <h3>Contact</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#div").tabs();
        });
    </script>
</div>
@endsection