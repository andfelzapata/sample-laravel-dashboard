@extends('layouts.site.site')

@section('title', 'Login')

<style>

    body.login {
        background: url("/images/login-bg.jpg");
        background-size: cover;
    }

    .form-wrapper {
        width: 25%;
        margin: 0 auto;
    }

    .form-signin {
        width: 100%;
        padding: 5% 10% 10% 10%;
    }

    .logo-container {
        width: 100%;
        background-color: #fff;
        text-align: center;
        padding: 5%;
    }

    .form-signin .form-signin-heading, .form-signin .checkbox {
        margin-bottom: 15%;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }


    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }

   .form-signin {
       background: url('/images/paper_texture.png');
   }

    body.login #main-content  {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    body.login .row
    {
        width: 100%;
    }

    body.login .btn-primary {
        color: #fff;
        background-color: #8ec545;
        border-color: #8fc637;
    }

    body.login h1 {
        color: #505e3b;
        text-align: center;
    }

    body.login .col-md-12 {
        display: flex;
        justify-content: center;
    }

    #form-errors .alert-danger {
        background-image: none;
    }

    #form-errors ul li {
        list-style: none;
        text-align: center;
    }
    
    #form-errors > * {
        text-align: center;
    }

</style>

@section('page-class', 'login')

@section('content')

    <div class="container-fluid" id="main-content">
        <div class="form-wrapper">

            <div class="logo-container">
                <img src="{{asset('images/logo.png')}}">
            </div>

            {!! Form::open(['ajax-login', 'url' => 'admin/login', 'class'  => 'form-signin', 'id' => 'login_form']) !!}
                <h1 class="form-signin-heading">Please sign in</h1>
                {!! Form::text('username', '', ['placeholder' => 'Username', 'class' => 'form-control']) !!}
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('remember-me', 'remember-me') !!} Remember me
                    </label>
                </div>

                {!! Form::submit('Sign in', ['class' => 'btn btn-lg btn-primary btn-block']) !!}

            {!! Form::close() !!}

            <!-- Display errors here -->
            <div id="form-errors"></div>

        </div><!-- End from-wrapper -->

    </div>

@endsection

@section('footer')

    <script src="{{ elixir('assets/js/auth.js') }}"></script>

    <script>

        Login.init('form[ajax-login]', '/admin/dashboard/');

    </script>

@endsection