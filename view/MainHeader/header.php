<header class="site-header">
    <div class="container-fluid">

        <a href="#" class="site-logo">
        
            <img class="hidden-md-down" src="../../public/img/logo_gerlashin.png" alt=""> <!-- logo-2.png -->
            <img class="hidden-lg-up" src="../../public/img/logo_gerlashin_mob.png" alt=""> <!-- logo-2-mob.png -->
            
        </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>toggle menu</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
        
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <!-- Icono de notificacion en el headeer -->
                    <div class="dropdown dropdown-notification notif">
                        <a href="../MntNotificacion/" class="header-alarm">
                            <i class="font-icon-alarm"></i>
                        </a>
                    </div>
                    <!-- Fin de icono de notificacion -->
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../../public/<?php echo $_SESSION["rol_id"] ?>.png" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="../MntPerfil/"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                            <a class="dropdown-item" href="http://localhost:8081/Helpdesk_Gerlashin/public/ManualDeUsuario_MesaDeAyuda_Gerlashin.pdf" target="_blank"><span class="font-icon glyphicon glyphicon-book"></span>Manual de Usuario</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesión</a>
                        </div>
                    </div>
                </div>

                <div class="mobile-menu-right-overlay"></div>

                <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>"><!-- ID del Usuario-->
                <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>"><!-- Rol del Usuario-->

                <div class="dropdown dropdown-typical">
                    <a href="http://localhost:8081/Helpdesk_Gerlashin/view/MntPerfil/" class="dropdown-toggle no-arr">
                        <span class="font-icon font-icon-user"></span>
                        <span class="lblcontactonomx"><?php echo $_SESSION["usu_nom"] ?> <?php echo $_SESSION["usu_ape"] ?></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>