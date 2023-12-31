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
    $id_vet = $_POST['id_vet'];
    $id_tiM = $_POST['id_tiM'];
    $id_servi = $_POST['id_servi'];
    $title = $_POST['title'];
    $nommas = $_POST['nommas'];
    $dueno = $_POST['dueno'];
    $color = $_POST['color'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];

    // Realizamos la consulta para saber si coincide con uno de esos criterios
    $sql = "select * from quotes where dueno='$dueno'";
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
        $sql2 = "insert into quotes(id_vet,id_tiM,id_servi,title,nommas,dueno,color,start,end,estado,precio) 
values ('$id_vet','$id_tiM','$id_servi','$title','$nommas','$dueno','$color','$start','$end','$estado','$precio')";

        if (mysqli_query($conn, $sql2)) {

            if ($sql2) {
            ?>



                <script type="text/javascript">
                    swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                        window.location = "../../folder/citas";
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

    <link href="../../assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">



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
            <div class="alert alert-info">
                <strong>Estimado usuario!</strong> Los campos remarcados con <span class="text-danger">*</span> son necesarios.
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REGISTRO DE CITAS RÁPIDAS
                                <small>Registra citas rapidas...</small>
                            </h2>


                        </div>
                        <!--==================================================================================================================================================-->
                        <div class="body">
                            <form method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label class="control-label">Nombre de la cita<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="title" class="form-control" placeholder="Nombre de la cita..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Veterinario<span class="text-danger">*</span></label>
                                        <select class="form-control show-tick" required name="id_vet" id="vete">
                                            <option value="">-- Seleccione un veterinario --</option>
                                            <?php
                                            try {
                                                $db = new Database();
                                                $dbcon = $db->open();
                                                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            } catch (PDOException $ex) {

                                                die($ex->getMessage());
                                            }
                                            $stmt = $dbcon->prepare('SELECT * FROM usuarios');
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                extract($row);
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Tipo de mascota<span class="text-danger">*</span></label>
                                        <select class="form-control show-tick" required name="id_tiM" id="tipomas">
                                            <option value="">-- Seleccione el tipo de mascota --</option>
                                            <?php
                                            try {

                                                $dbcon = $db->open();
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


                                </div>
                                <!--==================================================================================================================================================-->
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label class="control-label">Servicio<span class="text-danger">*</span></label>
                                        <select class="form-control show-tick" required name="id_servi" id="servicio">
                                            <option value="">-- Seleccione el servicio --</option>
                                            <?php
                                            try {

                                                $dbcon = $db->open();
                                                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            } catch (PDOException $ex) {

                                                die($ex->getMessage());
                                            }
                                            $stmt = $dbcon->prepare('SELECT * FROM service');
                                            $stmt->execute();

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                extract($row);
                                            ?>
                                                <option value="<?php echo $id_servi; ?>"><?php echo $nomser; ?></option>
                                            <?php
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Nombre de la mascota<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nommas" required class="form-control" placeholder="Nombre de la mascota..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Nombre del dueño<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="dueno" required class="form-control" placeholder="Nombre del dueño..." />
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!--==================================================================================================================================================-->

                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <label class="control-label">Color<span class="text-danger">*</span></label>
                                        <select class="form-control show-tick" required name="color">
                                            <option value="">-- Seleccione el color --</option>
                                            <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                            <option style="color:#e1ff00;" value="#e1ff00">&#9724; Amarillo</option>
                                            <option style="color:#ff0000;" value="#ff0000">&#9724; Rojo</option>
                                            <option style="color:#66ff00;" value="#66ff00">&#9724; Verde</option>
                                            <option style="color:#00ffd5;" value="#00ffd5">&#9724; Celeste</option>
                                            <option style="color:#ff00b3;" value="#ff00b3">&#9724; Morado</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Precio<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">monetization_on</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" required name="precio" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control money-euro" placeholder="Precio... Ex: $99,99">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Fecha de inicio<span class="text-danger">*</span></label>
                                            <div class='input-group date' name="start">
                                                <input type='datetime-local' name="start" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Fecha de fin<span class="text-danger">*</span></label>
                                        <div class="form-group">

                                            <div class='input-group date' name="end">
                                                <input type='datetime-local' name="end" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="display:none;">
                                        <div class="form-group">
                                            <label class="control-label">Estado</label>
                                            <select class="form-control form-control-line" name="estado">

                                                <option value="0">0</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid" align="center">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a type="button" href="../../folder/citas" class="btn bg-red"><i class="material-icons">cancel</i> CANCELAR </a>
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
            <!-- #END# Input -->
        </div>
    </section>
    <!-- #END# Colored Card - With Loading -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
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