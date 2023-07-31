<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Inspecciones ">
    <meta name="author" content="altosentido.net">
    <link rel="shortcut icon" href="{{ asset('assets/img/logoaunap.png') }}">
    <meta name="keyword" content="Sistema Inspecciones">

    <title>Sistema Inspecciones</title>

    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@150&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            background-image: url("{{ asset('assets/img/bg-login.png') }} ");
            background-size: cover;
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Roboto', sans-serif;
            font-weight: 100 !important;
        }

        #loginForm {
            background-image: url( "{{ asset('assets/img/bg-form-login.png') }}");
            background-color: #fff;
            background-size: 100% 94%;
            background-repeat: no-repeat;
            box-shadow: inset 0 0 10px 0 rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        #contramsg {
            color: #fff !important;
            margin-bottom: 0px !important;
            position: absolute;
            margin-top: 138px;
        }

        input,
        button {
            border-radius: 7px;
        }

        #logo {
            margin-top: 250px;
            margin-bottom: 0px;
            position: absolute;
            margin-left: -110px;
            width: 250px;
        }

        #logosm {
            width: 80px;
            height: 80px;
        }

        .card {
            border: none;
            background: transparent !important;
        }
    </style>

    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<!-- <body class="app flex-row align-items-center ozkr"> -->

<body class="app flex-row align-items-center ozkr">
    <div class="container">
        @yield('login')
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="js/plantilla.js"></script>

</body>

</html>
