<!DOCTYPE html>
<html>
<head>
	<title>Gerlashin - Encuesta de Satisfacción</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">
</head>
<body>

    <div class="container">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center"><b>Formato de Encuesta de Satisfacción.</b></h1>
            </div>
        </section>
        <hr><br />
        <section class="row">
            <section class="col-md-12">
                <h3><strong>Datos básicos</strong></h3>
                <p></p>
            </section>
        </section>
        <section class="row">
            <section class="col-md-12">
                <section class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto">Número de Ticket</label>
                            <input type="text" class="form-control" id="lblnomidticket" name="lblnomidticket" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto">Fecha de cierre</label>
                            <input type="text" class="form-control" id="lblfechacierre" name="lblfechacierre" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombreCompleto">Titulo</label>
                            <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Categoria</label>
                        <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Subcategoria</label>
                            <input type="text" class="form-control" id="subcat_nom" name="subcat_nom" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Prioridad</label>
                            <input type="text" class="form-control" id="priori_nom" name="priori_nom" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Usuario</label>
                        <input type="text" class="form-control" id="lblnomusuario" name="lblnomusuario" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Estado</label>
                            <input type="text" class="form-control" id="lblestado" name="lblestado" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Fecha de creación</label>
                            <input type="text" class="form-control" id="lblfechacreac" name="lblfechacreac" readonly>
                        </div>
                    </div>
                </section>

            </section>
        </section>
        <hr />

        <div id="panel1">

            <section class="row">
                <div class="col-md-12 text-center">
                    <input id="tick_evalstar" name="tick_evalstar" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="0">
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <h3>Comentarios.</h3>
                    <p></p>
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Comentarios:</label>
                        <textarea id="tick_comentstar" name="tick_comentstar" class="form-control" rows="6" id="comentarios"></textarea>
                    </div>
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-info" id="btnguardar">Guardar Encuesta</button>
                </div>
            </section>

        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="encuesta.js"></script>
<script>
    $('#tick_evalstar').rating({ 
        showCaption: false
    });
</script>
</body>
</html>