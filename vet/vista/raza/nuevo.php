﻿<?php
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="../panel-admin/administrador"> VETDOG - DASHBOARD </a>
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

    <!--============================CONTENIDO DE LA PÁGINA ==========================================================-->

    <section class="content">
        <div class="container-fluid">

            <div class="alert alert-info">
                <strong>Estimado usuario!</strong> Los campos remarcados con <span class="text-danger">*</span> son necesarios.
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REGISTRO DE RAZAS DE MASCOTAS
                                <small>Registra cualquier raza de una mascota...</small>
                            </h2>
                        </div>

                        <div class="body">
                            <form method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label class="control-label">Nombre de la raza de mascota<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nomraza" required class="form-control" placeholder="Nombre de la raza de mascota..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Tipo de mascota<span class="text-danger">*</span></label>
                                        <select class="form-control show-tick" name="id_tiM">
                                            <option value="">-- Seleccione un tipo --</option>
                                            <?php
                                            $dbhost = 'localhost';
                                            $dbname = 'vetdog';
                                            $dbuser = 'root';
                                            $dbpass = '';

                                            try {

                                                $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
                                                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            } catch (PDOException $ex) {

                                                die($ex->getMessage());
                                            }
                                            $stmt = $dbcon->prepare('SELECT * FROM pet_type');
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                extract($row);
                                            ?>
                                                <option value="<?php echo $id_tiM; ?>"><?php echo $noTiM; ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-sm-5" style="display:none;">
                                        <select name="estado" class="form-control show-tick">

                                            <option value="1">1</option>

                                        </select>
                                    </div>



                                </div>

                                <div class="container-fluid" align="center">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a type="button" href="../../folder/raza" class="btn bg-red"><i class="material-icons">cancel</i> LIMPIAR </a>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">


                                        <button class="btn bg-green" name="agregar">GUARDAR<i class="material-icons">save</i></button>
                                    </div>

                                </div>
                            </form>
                        </div>
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

    <?php
    if (isset($_POST["agregar"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vetdog";

        // Creamos la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Revisamos la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nomraza = $_POST['nomraza'];
        $id_tiM = $_POST['id_tiM'];
        $estado = $_POST['estado'];

        // Realizamos la consulta para saber si coincide con uno de esos criterios
        $sql = "select * from raza where nomraza='$nomraza'";
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
            $sql2 = "insert into raza(nomraza,id_tiM,estado) 
values ('$nomraza','$id_tiM','$estado')";

            if (mysqli_query($conn, $sql2)) {

                if ($sql2) {
                ?>



                    <script type="text/javascript">
                        swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                            window.location = "../../folder/raza";
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

</body>

</html>