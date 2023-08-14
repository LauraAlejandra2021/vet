﻿<?php
session_start();

if (!isset($_SESSION['cargo']) == 1) {
    header('location: ../vista/pages-login');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Vetdog V.1 | Vetdog - Vetdog Admin Template</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/lll.png" />

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

    <!-- LUPA -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons"></i>
        </div>
        <input type="text" placeholder="Buscar...">
        <div class="close-search">
            <i class="material-icons">X</i>
        </div>
    </div>
    <!-- //LUPA -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../vista/panel-admin/administrador"> VETDOG - DASHBOARD </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php include('../menu.php'); ?>



    <!--=============================================================CONTENIDO DE LA PÁGINA =============================================================-->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Listado de compras :
                            </h2><br>

                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <?php
                                $contraseña = "";
                                $usuario = "root";
                                $nombre_base_de_datos = "vetdog";
                                try {
                                    $base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
                                    $base_de_datos->query("set names utf8;");
                                    $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                                    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                                } catch (Exception $e) {
                                    echo "Ocurrió algo con la base de datos: " . $e->getMessage();
                                }

                                $sentencia = $base_de_datos->query("SELECT  compra.fecha, compra.id_compra,compra.estado, compra.total,compra.tipoc, compra.tipopa, supplier.id_prove, supplier.nomprove, supplier.ruc, supplier.direcc, supplier.pais, supplier.tele, supplier.corre,
GROUP_CONCAT( products.nompro, '..', products.codigo, '..',products.preciC, '..', productos_comprados.canti SEPARATOR '__') AS products FROM compra INNER JOIN productos_comprados ON productos_comprados.id_compra = compra.id_compra INNER JOIN products ON products.id_prod = productos_comprados.id_prod INNER JOIN supplier ON compra.id_prove =supplier.id_prove GROUP BY compra.id_compra ORDER BY compra.id_compra DESC;");
                                $compras = $sentencia->fetchAll(PDO::FETCH_OBJ);
                                ?>
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>COMPROBANTE</th>
                                            <th>FECHA</th>

                                            <th>TOTAL</th>
                                            <th>PROVEDDOR</th>

                                            <th>ESTADO</th>
                                            <th>DETALLES</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($compras as $compra) { ?>
                                            <tr>
                                                <td><?php echo $compra->tipoc ?></td>
                                                <td><?php echo $compra->fecha ?></td>



                                                <td>S/.<?php echo $compra->total ?></td>
                                                <td><?php echo $compra->nomprove ?></td>

                                                <td>
                                                    <?php

                                                    if ($compra->estado == 1) { ?>
                                                        <form method="get" action="javascript:activo('<?php echo $compra->id_compra; ?>')">

                                                            <span class="label label-success">Aceptado</span>
                                                        </form>
                                                    <?php  } else { ?>

                                                        <form method="get" action="javascript:inactivo('<?php echo $compra->id_compra; ?>')">
                                                            <button type="submit" class="btn btn-danger btn-xs">Anuladas</button>
                                                        </form>
                                                    <?php  } ?>
                                                </td>
                                                <td>
                                                    <a type="button" href="../vista/compra/detalles?id=<?php echo $compra->id_compra; ?>" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">remove_red_eye</i>

                                                    </a>
                                                </td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--------------------------------script edit cate----------------------------->

</body>

</html>