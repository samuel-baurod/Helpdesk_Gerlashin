<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Gerlashin - Perfil</title>

<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php"); ?>

	<div class="mobile-menu-left-overlay"></div>

	<?php require_once("../MainNav/nav.php"); ?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Perfil</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="http://localhost:8081/Helpdesk_Gerlashin/view/Home/">Inicio</a></li>
								<li class="active">Cambiar Contraseña</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<div class="row">

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="cat_id">Nueva Contraseña</label>
								<input type="password" class="form-control" id="txtpass" name="txtpass">
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="fileElem">Confirmar Contraseña</label>
								<input type="password" class="form-control" id="txtpassnew" name="txtpassnew">
							</fieldset>
						</div>
						
						<div class="col-lg-12">
							<button type="button" id="btnactualizar" class="btn btn-rounded btn-inline btn-primary">Actualizar</button>
						</div>
					
				</div>

			</div>
		</div>
	</div>
	<!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>
	<script type="text/javascript" src="mntperfil.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>

</body>
</html>
<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>