    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Inspección de embarcaciones pesqueras">
        <meta name="author" content="Inspecciones">
        <meta name="keyword" content="Sistema de inspecciones">
        <link rel="shortcut icon" href="{{ asset('assets/img/logoaunap.png') }}">
        <title>Sistema Inspecciones</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Icons -->
        <link rel="stylesheet"
            href="//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700,400italic|Material+Icons">
        <!-- <link rel="stylesheet" href="../node_modules/material-design-icons-iconfont/dist/material-design-icons.css"> -->
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" --}}

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css "> --}}

        {{-- <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css"> --}}
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

        <style>
            body {
                background: #fff;
                font-family: 'Roboto';
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-weight: 300 !important;
            }

            b {
                font-weight: 400 !important;
            }

            small {
                font-weight: 300 !important;
                font-size: 0.7em;
            }

            table thead th,
            table tfoot tr th,
            table tr td {
                font-size: 0.9em;
            }

            table tr td button {
                padding: 5px;
                border-radius: 7px;
            }

            button,
            .md-button-content {
                border-radius: 7px;
            }

            .modal-content {
                border-radius: 8px !important;
            }

            .modal-footer button {
                border-radius: 7px;
            }
        </style>

        @yield('styles')
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <div id="app">
            <header class="app-header navbar">
                <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                    <span class="navbar-toggler-icon fa fa-bars text-white"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
                <button id="close-sidebar" class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                    <span class="navbar-toggler-icon fa fa-bars text-white"></span>
                </button>

                <ul class="nav navbar-nav ml-auto" style="margin-right: 30px">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link text-white" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="d-md-down-none text-white">{{ Auth::user()->nom }} </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header text-center">
                                <strong>Cuenta</strong>
                            </div>

                            <a class="dropdown-item" href="#" @click="menu=22">
                                <i class="fa fa-user"></i> Perfil
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-lock"></i> Cerrar sesión
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>

                        </div>
                    </li>
                </ul>
            </header>


            <div class="app-body">
                @if (Auth::user()->idrol == 1)
                    @include('plantilla.sidebaradministrador')
                @elseif (Auth::user()->idrol == 2)
                    @include('plantilla.sidebarUsuario')
                @elseif (Auth::user()->idrol == 3)
                    {{-- @include('plantilla.sidebarCoordinador') --}}
                @else
                @endif

                <!-- Contenido Principal -->
                @yield('contenido')
                <!-- /Fin del contenido principal -->
            </div>

        </div>
        </div>
        <footer class="app-footer" style="padding-left: 45px">
            <span><a href="https://altosentido.net">Alto Sentido</a> &copy; 2023</span>
            <span class="ml-auto">Desarrollado por <a href="http://www.altosentido.net/">Alto Sentido</a></span>
        </footer>


        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> -->
        {{-- <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> --}}
        {{-- <script  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>     --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/vue-tables-2@2.0.18/dist/vue-tables-2.min.js"></script> --}}
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            // Note that the name "myDropzone" is the camelized
            // id of the form.
            Dropzone.options.myDropzone = {
                // Configuration options go here
            };
        </script>
        <script src="js/app.js"></script>
        <script src="js/plantilla.js"></script>


    </body>
    <script language="javascript">
        jQuery(function($) {

            // Dropdown menu
            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if ($(this).parent().hasClass("active")) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).parent().removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).next(".sidebar-submenu").slideDown(200);
                    $(this).parent().addClass("active");
                }

            });

            //toggle sidebar
            $("#toggle-sidebar").click(function() {
                $(".page-wrapper").toggleClass("toggled");
            });
            //Pin sidebar
            $("#pin-sidebar").click(function() {
                if ($(".page-wrapper").hasClass("pinned")) {
                    // unpin sidebar when hovered
                    $(".page-wrapper").removeClass("pinned");
                    $("#sidebar").unbind("hover");
                } else {
                    $(".page-wrapper").addClass("pinned");
                    $("#sidebar").hover(
                        function() {
                            console.log("mouseenter");
                            $(".page-wrapper").addClass("sidebar-hovered");
                        },
                        function() {
                            console.log("mouseout");
                            $(".page-wrapper").removeClass("sidebar-hovered");
                        }
                    )

                }
            });


            //toggle sidebar overlay
            $("#overlay").click(function() {
                $(".page-wrapper").toggleClass("toggled");
            });

            //switch between themes 
            var themes = "default-theme legacy-theme chiller-theme ice-theme cool-theme light-theme";
            $('[data-theme]').click(function() {
                $('[data-theme]').removeClass("selected");
                $(this).addClass("selected");
                $('.page-wrapper').removeClass(themes);
                $('.page-wrapper').addClass($(this).attr('data-theme'));
            });

            // switch between background images
            var bgs = "bg1 bg2 bg3 bg4";
            $('[data-bg]').click(function() {
                $('[data-bg]').removeClass("selected");
                $(this).addClass("selected");
                $('.page-wrapper').removeClass(bgs);
                $('.page-wrapper').addClass($(this).attr('data-bg'));
            });

            // toggle background image
            $("#toggle-bg").change(function(e) {
                e.preventDefault();
                $('.page-wrapper').toggleClass("sidebar-bg");
            });

            // toggle border radius
            $("#toggle-border-radius").change(function(e) {
                e.preventDefault();
                $('.page-wrapper').toggleClass("boder-radius-on");
            });

            //custom scroll bar is only used on desktop
            if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                $(".sidebar-content").mCustomScrollbar({
                    axis: "y",
                    autoHideScrollbar: true,
                    scrollInertia: 300
                });
                $(".sidebar-content").addClass("desktop");

            }
        });
    </script>

    @yield('scripts')

    </html>
