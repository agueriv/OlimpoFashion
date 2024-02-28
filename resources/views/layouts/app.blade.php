<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ariel Guerrero">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{ url('backassets/static/ico_olimpo.svg') }}">
    <title>@yield('title')</title>
    <link href="{{ url('backassets/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ url('backassets/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            @yield('content')
        </div>
    </div>
    <script src="{{ url('backassets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('backassets/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ url('backassets/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
