<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Garden Revolutionss - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap-theme.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/font-awesome.min.css') }}">

    <script type="text/javascript" src=" {{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);

        body {
            font-family: "Raleway" !important;
        }
    </style>


</head>

<body class="@yield('page-class')">

    @yield('content')

    <script type="text/javascript" src=" {{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

</body>
</html>