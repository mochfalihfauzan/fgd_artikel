<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel FGD FYP Media | {{ $title }}</title>

    {{-- Menambahkan Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    {{--  Menambahkan Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- my style --}}
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
            top: 0;
        }

        .main-container {
            margin-top: 100px;
        }

        footer {
            width: 100%;
            position: relative;
            bottom: 0;
        }
    </style>

</head>

<body>
    @include('partials.navbar')
    <div class="container main-container" style="min-height: 100vh">
        @yield('container')
    </div>

    @include('partials.footer')

    {{-- Menambahkan Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
