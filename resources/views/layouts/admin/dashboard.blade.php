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

    <style type="text/css">

        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700);

        body, html {
            font-family: "Source Sans Pro";
            color: #fff;
        }

        .navbar-default .navbar-brand {
            color: #fff;
        }

        .navbar-default a .fa, .caret {
            color: #fff;
        }

        .fa-2 {
            font-size: 2em;
        }

        #main-content {
            color: #000;
        }

        .menu-toggle {
            background-color: inherit;
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 0px;
            float: left;
            padding: 12px 15px;
            line-height: 20px;
        }

        a.menu-toggle:focus, a.menu-toggle:hover {
            color: transparent;;
        }

        .menu-toggle.sidebar-open {
            display: none;
        }

        #user-options .dropdown-menu .fa {
            color: #000;
        }

        #user-options > li.dropdown {
            float: left;
            padding: 5%;
            border-left: 1px solid rgba(0,0,0, 0.1);
        }

        #sidebar-wrapper {
            z-index: 1000;
            position: fixed;
            height: 100%;
            min-height: 100%;
            width: 33.33%;
            left: 0;
            overflow-y: auto;
            background: #8dc53e;
        }

        /* Sidebar Styles */

        .sidebar-nav {
            padding: 0;
            list-style: none;
        }

        .sidebar-nav li {
            text-indent: 20px;
            line-height: 40px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #fff;
            font-size: 18px;
        }

        .sidebar-nav li a:hover {
            text-decoration: none;
            color: #fff;
            background: rgba(255,255,255,0.2);
        }

        .navbar-default .navbar-nav>.open>a,
        .navbar-default .navbar-nav>.open>a:focus,
        .navbar-default .navbar-nav>.open>a:hover {
            background: rgba(255,255,255,0.2) !important;
        }

        a i.fa {
            display: inline;
            padding-right: 5%;
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
            text-decoration: none;
        }

        .sidebar-nav > .sidebar-brand {
            height: 65px;
            font-size: 18px;
            line-height: 60px;
        }

        .sidebar-nav > .sidebar-brand a {
            color: #999999;
        }

        .sidebar-nav > .sidebar-brand a:hover {
            color: #fff;
            background: none;
        }

        .sidebar-menu-divider {
            border-bottom: 1px solid #55a500;
        }

        .sidebar-menu-item-active {
            border-left: 4px solid #55a500;
            padding-left: 2px !important;
            background: rgba(255,255,255,0.2);

        }

        .navbar-default .navbar-collapse, .navbar-default .navbar-form {
            border-color: transparent;
        }

        .navbar-collapse {
            padding-left: 0px;
            padding-right: 0px;
        }

        .fa.fa-sitemap {
            padding-right: 7%;
        }

        i.fa.fa-lock {
            vertical-align: middle;
            margin-left: 2px;
            font-size: 10px;
            padding-right: 0px;
            margin-right: -5px;
        }

        .fa {
            height: 25px;
            width: auto;
        }

        img.plant-library, img.pests-library, img.procedure-library, img.plant-category {
            vertical-align: middle;
            height: 30px;
            margin-left: -5px;
            width: auto;
            padding-right: 13px;
        }

        .navbar-default .navbar-nav>li>a {
            font-size: 18px;
        }

        .sidebar-nav li {
            padding-left: 6px;
        }

        .sidebar-nav li:hover {
            border-left:  4px solid #55a500;
            padding-left: 2px;
        }

        .navbar-default {
            background: #bdb386;
            margin-bottom: 0px;
            border: none;
            border-radius: 0px;
        }

        #main-content {
            color: #000;
            font-size: 18px;
        }

        #main-content p {
            font-size: 18px;
        }

        .navbar-default .navbar-brand:hover {
            color: #fff;
        }

        .btn-primary:hover {
            background: #337ab7;
        }

        .btn-danger {
            background-color: #c9302c;
        }

        .btn-danger:hover {
            background-color: #c93000;
        }

        .btn-success {
            color: #fff;
            background-color: #8ec545;
            border-color: #8fc637;
        }

        .table-filter {
            display: inline-block;
            float: right;
            width: 40%;
        }

        .table {
            margin-top: 5%;
        }

        .table>tbody>tr>td, 
        .table>tbody>tr>th, 
        .table>tfoot>tr>td, 
        .table>tfoot>tr>th, 
        .table>thead>tr>td, 
        .table>thead>tr>th {
            
        }

        ::-webkit-input-placeholder::before { 
            font-family: fontAwesome; 
            content:'\f002  ';
        }
        ::-moz-placeholder::before  { 
            font-family: fontAwesome; 
            content:'\f002  '; 
        } /* firefox 19+ */

        :-ms-input-placeholder::before { 
            font-family: fontAwesome; 
            content:'\f002  ';
        } /* ie */
    
        input:-moz-placeholder::before { 
            font-family: fontAwesome; 
            content:'\f002  ';
        }

        .primary-name {
            color: #55a500;
        }

        .primary-name:hover {
            color: #55a500;
            text-decoration: none;
        }


        @media(min-width:768px) {

        }

    </style>

</head>

<body>

@include('admin.partials.navbar')

<div class="container-fluid">
    <div class="row">
        <div id="menu-sidebar" class="col-md-4">

            @include('admin.partials.sidebar')

        </div>

        <div id="main-content" class="col-md-8">

            @yield('content')

        </div>
    </div>
</div>

<script type="text/javascript" src=" {{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

<script type="text/javascript" src=" {{ asset('vendor/underscore/underscore.js') }}"></script>

<script type="text/javascript" src=" {{ asset('vendor/backbone/backbone.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/typeahead/typeahead.bundle.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/tablesorter/jquery.tablesorter.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/admin.js') }}"></script>

</body>
</html>