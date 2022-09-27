<?php
    //Llamada a las clases necesarias
	require_once("../config/conexion.php");
    
?>

<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Recuperar Contraseña</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="../public/img/ico_gerlashin.ico" rel="shortcut icon">

<link rel="stylesheet" href="../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box reset-password-box">
                    <header class="sign-title">Ingrese su correo electrónico</header>
                    <div class="form-group">
                        <input type="email" class="form-control" id="usu_correo" placeholder="Correo electrónico"/>
                    </div>
                    <button type="button" class="btn btn-rounded btn-inline btn-primary" id="btnrecuperar">Recuperar</button>
                    o bien: <a href="http://localhost:8081/Helpdesk_Gerlashin/">Inicie Sesión</a>
                </form>
            </div>
        </div>
    </div><!--Div page-center-->

<script src="../public/js/lib/jquery/jquery.min.js"></script>
<script src="../public/js/lib/tether/tether.min.js"></script>
<script src="../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../public/js/plugins.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    
    <!-- Script que centra el contenedor -->
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="../public/js/app.js"></script>
<script type="text/javascript" src="recuperarcontrasena.js"></script>
</body>
</html>























<!--
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Recuperar Contraseña | Mesa de Partes</title>
        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Codebase">
        <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <link rel="shortcut icon" href="../public/assets/img/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../public/assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../public/assets/img/favicons/apple-touch-icon-180x180.png">
        <link rel="stylesheet" id="css-main" href="../public/assets/css/codebase.min.css">
    </head>
    <body>
        <div id="page-container" class="main-content-boxed">
            <main id="main-container">
                <div class="bg-image" style="background-image: url('../public/assets/img/photos/photo34@2x.jpg');">
                    <div class="row mx-0 bg-black-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 invisible" data-toggle="appear">
                                <p class="font-size-h3 font-w600 text-white">
                                    Nombre Empresa
                                </p>
                                <p class="font-italic text-white-op">
                                    Copyright &copy; <span class="js-year-copy">2017</span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                            <div class="content content-full">
                                <div class="px-30 py-10">
                                    <a class="link-effect font-w700" href="index.html">
                                        <i class="si si-fire"></i>
                                        <span class="font-size-xl text-primary-dark">Mesa de </span><span class="font-size-xl">Partes</span>
                                    </a>
                                    <h2 class="h5 font-w400 text-muted mb-0">Recuperar Contraseña</h2>
                                </div>
                                <div class="px-30">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="usu_correo" name="usu_correo">
                                                <label for="usu_correo">Correo Electronico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-hero btn-alt-primary" id="btnrecuperar">
                                            <i class="si si-login mr-10"></i> Recuperar
                                        </button>
                                        <div class="mt-30">
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="../">
                                                <i class="fa fa-plus mr-5"></i> Acceso
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="../public/assets/js/core/jquery.min.js"></script>
        <script src="../public/assets/js/core/popper.min.js"></script>
        <script src="../public/assets/js/core/bootstrap.min.js"></script>
        <script src="../public/assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../public/assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../public/assets/js/core/jquery.appear.min.js"></script>
        <script src="../public/assets/js/core/jquery.countTo.min.js"></script>
        <script src="../public/assets/js/core/js.cookie.min.js"></script>
        <script src="../public/assets/js/codebase.js"></script>
        <script src="../public/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../public/assets/js/pages/op_auth_signin.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript" src="recuperarcontrasena.js"></script>
    </body>
</html> --> 