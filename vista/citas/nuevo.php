﻿<?php

require_once ('../../assets/db/config.php');
session_start();

if (!isset($_SESSION['cargo']) == 1) {
    header('location: ../pages-login');
}

if (isset($_POST["agregar"])) {
    // Creamos la conexión
    $db = new Database();
    $conn = $db->getMysqli();

    // Revisamos la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $nomcate = $_POST['nomcate'];
    $estado = $_POST['estado'];

    // Realizamos la consulta para saber si coincide con uno de esos criterios
    $sql = "select * from category where nomcate='$nomcate'";
    $result = mysqli_query($conn, $sql);
?>


    <?php
    // Validamos si hay resultados
    if (mysqli_num_rows($result) > 0) {
        // Si es mayor a cero imprimimos que ya existe el usuario

        if ($result) {
    ?>

            <script type="text/javascript">
                swal("Oops...!", "Ya existe el registro a agregar!", "error")
            </script>

            <?php
        }
    } else {
        // Si no hay resultados, ingresamos el registro a la base de datos
        $sql2 = "insert into category(nomcate,estado) 
values ('$nomcate','$estado')";

        if (mysqli_query($conn, $sql2)) {

            if ($sql2) {
            ?>



                <script type="text/javascript">
                    swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                        window.location = "../../folder/categorias";
                    });
                </script>


            <?php
            } else {
            ?>
                <script type="text/javascript">
                    swal("Oops...!", "No se pudo guardar!", "error")
                </script>
<?php

            }
        } else {

            echo "Error: " . $sql2 . "" . mysqli_error($conn);
        }
    }
    // Cerramos la conexión
    $conn->close();
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
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
    <!-- Loading -->
    <?php include_once __DIR__ . '../../commons/loading.php'; ?>

    <!-- Header -->
    <?php include_once __DIR__ . '../../commons/header.php'; ?>

    <!-- Menu -->
    <?php include_once __DIR__ . '../../menu.php'; ?>
    <!--============================CONTENIDO DE LA PÁGINA ==========================================================-->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h1>SELECCIÓN DE TIPOS DE CITAS</h1>
            </div>
            <!-- Colored Card - With Loading -->
            <div class="block-header">
                <h2>
                    Escoja como Generar su Cita
                    <small>Clic sobre el Encabezado de Color Celeste para los Citas rapidas </small>
                </h2>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="card">
                        <a href="cita_rapida">
                            <div class="header bg-light-blue">
                                <h2>
                                    CITAS RÁPIDAS <small></small>
                                </h2>
                            </div>
                        </a>

                        <div class="body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat: <br><br>
                            <b>1.-</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br>
                            <b>2.-</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>

                        <div class="info-box-4 hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons col-blue">devices</i>
                            </div>
                            <div class="content">
                                <div class="number">VETDOG</div>
                                <div class="text">CITAS RÁPIDAS</div>
                            </div>
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </section>
    <!-- #END# Colored Card - With Loading -->

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

</body>

</html>