<html>
<head>
    <title>Garden Revolution - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">

</head>
<body>

    @include('dashboard.partials.navbar')

    <div class="container">

        @yield('content')

    </div>

</body>

<script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/underscore/underscore.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/backbone/backbone.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

</html>