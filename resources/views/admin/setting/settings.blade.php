@extends('admin.layout.master')
@section('page-name', 'Website Settings')
@section('admin-content')
    <div class="container-fluid py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="div">
            <ul>
                <li><a href="#logo">Logo</a></li>
                <li><a href="#favicon">Favicon</a></li>
                <li><a href="#Website_name">Website Name</a></li>
                <li><a href="#Welcome_message">Welcome Message</a></li>
                <li><a href="#footer">Footer</a></li>
                <li><a href="#social_links">Social Networks</a></li>
            </ul>
            <section id="logo">
                <h3>Logo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>

            <section id="favicon">
                <h3>Favicon</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>

            <section id="Website_name">
                <h3>Website Name</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            </section>

            <section id="Welcome_message">
                <h3>Welcome Message</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            </section>
            <section id="footer">
                <h3>Footer</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>
            <section id="social_links">
                <h3>Social Networks</h3>
                @include('admin.setting.social')
            </section>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#div").tabs();
            });
        </script>
    </div>
@endsection
