<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        @include('user.layout.header')
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-5 mt-auto">
        @include('user.layout.footer')
    </footer>
    <script>
        $(document).ready(function() {
            $('#profileImage').click(function(event) {
                event.stopPropagation(); // Prevent the click event from bubbling up
                $('#dropdownMenu').toggle(); // Toggle the dropdown menu
            });

            // Close the dropdown if clicked outside
            $(document).click(function(event) {
                if (!$(event.target).closest('.profile').length) {
                    $('#dropdownMenu').hide(); // Hide the dropdown menu
                }
            });
        });
        @if ($errors->any())
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        @endif

        // Automatically hide the alert after 5 seconds
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
</body>

</html>
