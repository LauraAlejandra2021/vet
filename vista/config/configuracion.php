﻿<?php
require_once('../../assets/db/config.php');
session_start();

if (!isset($_SESSION['cargo']) == 1) {
    header('location: ../pages-login');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Vetdog - Vetdog Admin Template</title>
    <!-- Google Font - Iconos -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Select Css -->
    <link href="../../assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Bootstrap Core Css -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../../assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/lll.png" />



</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Header -->
    <?php include_once __DIR__ . '../../commons/header.php'; ?>

    <!-- Menu -->
    <?php include_once __DIR__ . '../../menu.php'; ?>
    <!--============================CONTENIDO DE LA PÁGINA ==========================================================-->

    <section class="content">
        <div class="container-fluid">
            <!-- Input -->


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="header">
                            <h2>
                                MI INFORMACION

                            </h2>
                        </div>
                        <?php
                        $db = new Database();
                        $con = $db->getMysqli();

                        $sql = "SELECT * FROM business";
                        $query = $con->query($sql);
                        $data = array();
                        if ($query) {
                            while ($r = $query->fetch_object()) {
                                $data[] = $r;
                            }
                        }

                        ?>
                        <?php if (count($data) > 0): ?>
                            <?php foreach ($data as $d): ?>

                                <div class="body">
                                    <form method="POST" action="../config/editar?id=<?php echo $d->id_buss; ?>"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <div class="row clearfix">

                                            <div class="col-sm-4">
                                                <label class="control-label">RUC de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input id="codigo_barras" value="<?php echo $d->ruc; ?>" type="text"
                                                            name="ruc"
                                                            onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                            maxlength="14" required class="form-control"
                                                            placeholder="Nombre de la empresa..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Nombre de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input value="<?php echo $d->noemp; ?>" type="text" name="noemp"
                                                            required class="form-control"
                                                            placeholder="Nombre de la empresa..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Direccion de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input value="<?php echo $d->direcc; ?>" type="text" name="direcc"
                                                            required class="form-control"
                                                            placeholder="Direccion de la empresa..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Correo de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input value="<?php echo $d->correo; ?>" type="text" name="correo"
                                                            required class="form-control"
                                                            placeholder="Correo de la empresa..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Telefono de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input value="<?php echo $d->telef; ?>" type="text" name="telef"
                                                            required class="form-control"
                                                            placeholder="Telefono de la empresa..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <label class="control-label">Descripcion de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea rows="4" value="<?php echo $d->descp; ?>" name="descp"
                                                            class="form-control no-resize"
                                                            placeholder="Descripcion..."><?php echo $d->descp; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Foto de la empresa</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <img src="../../assets/img/subidas/<?php echo $d->foto; ?>" alt=""
                                                            style="" width="190px" height="200px">
                                                        <p style="margin-left:60px;">Antigua</p>

                                                        <input type="file" class="form-control" name="foto" id="imagen"
                                                            maxlength="256" placeholder="Imagen">
                                                        <input type="hidden" class="form-control" name="imagenactual"
                                                            id="imagenactual">
                                                        <img src="" width="150px" height="120px" id="imagenmuestra">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="container-fluid" align="center">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                <a type="button" href="../panel-admin/administrador" class="btn bg-red"><i
                                                        class="material-icons">cancel</i> CANCELAR </a>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">


                                                <button class="btn bg-green" name="update">EDITAR<i
                                                        class="material-icons">save</i></button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                No hay datos
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/plugins/node-waves/waves.js"></script>
    <!-- Autosize Plugin Js -->
    <script src="../../assets/plugins/autosize/autosize.js"></script>
    <!-- Moment Plugin Js -->
    <script src="../../assets/plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->

    <!-- Bootstrap Datepicker Plugin Js -->

    <!-- Custom Js -->
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->

    <script src="../../assets/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--------------------------------script nuevo----------------------------->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Asignamos el atributo src a la tag de imagen
                    $('#imagenmuestra').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // El listener va asignado al input
        $("#imagen").change(function () {
            readURL(this);
        });
    </script>

</body>

</html>