<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

?>

<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Nueva Contraseña</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="../public/img/ico_gerlashin.ico" rel="icon" type="image/png">
    <link href="../public/img/ico_gerlashin.ico" rel="shortcut icon">

<link rel="stylesheet" href="../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">

    <link rel="stylesheet" href="../public/css/lib/bootstrap-sweetalert/sweetalert.css">
<link rel="stylesheet" href="../public/css/separate/vendor/sweet-alert-animations.min.css">

</head>
<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box reset-password-box">
                    <!--<div class="sign-avatar">
                        <img src="img/avatar-sign.png" alt="">
                    </div>-->
                    <header class="sign-title">Ingrese su nueva contraseña</header>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtpasslog" name="txtpasslog" placeholder="Nueva Contraseña"/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtpassnewlog" name="txtpassnewlog" placeholder="Confirmar Nueva Contraseña"/>
                    </div>
                    
                    <button type="button" id="btnlactualizar" name="btnlactualizar" class="btn btn-rounded btn-block">Actualizar</button>
                    
                    <div class="float-center reset" style='text-align:center'>
                        <a href="http://localhost:8081/Helpdesk_Gerlashin/"><b>Iniciar Sesión</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="../public/js/lib/jquery/jquery.min.js"></script>
<script src="../public/js/lib/tether/tether.min.js"></script>
<script src="../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../public/js/plugins.js"></script>
<script src="../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
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
<script type="text/javascript" src="nuevacontrasena.js"></script>
</body>
</html>
