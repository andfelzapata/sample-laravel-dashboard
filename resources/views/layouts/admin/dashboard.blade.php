<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Garden Revolutions - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap-theme.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-switch/bootstrap-switch.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/magicsuggest/magicsuggest-min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/selectize/selectize.bootstrap3.css') }}">
 
   <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">

    <script type="text/javascript" src=" {{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer '+ localStorage.getItem('token')
            }
        });
    </script>
</head>
<body>

@include('admin.partials.navbar')
<div class="clear-fix" style="margin: 80px 0px"></div>

<div class="container-fluid" id="content-body">
    <div class="row">
        <div id="menu-sidebar" class="col-md-2">

            @include('admin.partials.sidebar')

        </div>

        <div id="main-content" class="col-md-10">

            @yield('content')

        </div>
    </div>
</div>

<script type="text/javascript" src=" {{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/bootstrap-switch/bootstrap-switch.min.js') }}"></script>

<script type="text/javascript" src=" {{ asset('vendor/underscore/underscore.js') }}"></script>

<script type="text/javascript" src=" {{ asset('vendor/backbone/backbone.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/typeahead/typeahead.bundle.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/handlebars/handlebars.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/tablesorter/jquery.tablesorter.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/magicsuggest/magicsuggest-min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/selectize/selectize.min.js') }}"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript" src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>

<script src="{{ elixir('assets/js/admin.js') }}"></script>

</body>
</html>
