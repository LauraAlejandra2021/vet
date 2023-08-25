﻿<?php
require_once '../../assets/db/config.php';

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
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="../../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
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
        <?php include_once __DIR__ . '../../menu.php'; ?>    <!--============================CONTENIDO DE LA PÁGINA ==========================================================-->

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
                                REGISTRO DE CLIENTES
                                <small>Registra cualquier cliente...</small>
                            </h2>
                        </div>

                        <div class="body">
                            <form method="POST" autocomplete="off" enctype="multipart/form-data">

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label class="control-label">DNI del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="dni_due" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="8" required class="form-control" placeholder="DNI del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Nombre del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nom_due" required class="form-control" placeholder="Nombre del cliente..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Apellido del cliente<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="ape_due" required class="form-control" placeholder="Apellido del cliente..." />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <label class="control-label">Telefono movil<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="movil" required onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9" class="form-control" placeholder="Telefono movil..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Telefono fijo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="fijo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="6" class="form-control" placeholder="Telefono fijo..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Correo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Direccion</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="direc" class="form-control" placeholder="Direccion..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Usuario<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="usuario" required class="form-control" placeholder="Usuario..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label">Contraseña<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="contra" required class="form-control" placeholder="Contraseña..." />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">

                                        <label class="control-label">Imagen</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="imagen" name="foto" onchange="readURL(this);" data-toggle="tooltip">
                                                <img id="blah" src="http://placehold.it/180" alt="your image" style="max-width:90px;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5" style="display:none;">
                                        <select name="estado" class="form-control show-tick">

                                            <option value="1">1</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-5" style="display:none;">
                                        <select name="cargo" class="form-control show-tick">

                                            <option value="2">2</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="container-fluid" align="center">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a type="button" href="../../folder/clientes" class="btn bg-red"><i class="material-icons">cancel</i> CANCELAR </a>
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
    <script src="../../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->

    <script src="../../assets/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <!--------------------------------script nuevo----------------------------->

<?php
if (isset($_POST["agregar"])) {
    // Creamos la conexión
    $db = new Database();
    $conn = $db->getMysqli();

    // Revisamos la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dni_due = $_POST['dni_due'];
    $nom_due = $_POST['nom_due'];
    $ape_due = $_POST['ape_due'];

    $movil = $_POST['movil'];
    $fijo = $_POST['fijo'];
    $correo = $_POST['correo'];
    $direc = $_POST['direc'];
    $estado = $_POST['estado'];
    $usuario = $_POST['usuario'];
    $contra = MD5($_POST['contra']);
    $cargo = $_POST['cargo'];
    $foto = $_FILES['foto']['name'];

    // Realizamos la consulta para saber si coincide con uno de esos criterios
    $sql = "select * from owner where dni_due='$dni_due' or movil='$movil' or fijo='$fijo'";
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
        $sql2 = "insert into owner(dni_due,nom_due,ape_due,movil,fijo,correo,direc,estado,usuario,contra,cargo,foto) 
values ('$dni_due','$nom_due','$ape_due','$movil','$fijo','$correo','$direc','$estado','$usuario',
'$contra','$cargo','$foto')";
        $foto = $_FILES['foto'];

        move_uploaded_file($foto['tmp_name'], "../../assets/img/subidas/" . $foto['name']);
        if (mysqli_query($conn, $sql2)) {

            if ($sql2) {
            ?>


                <script type="text/javascript">
                    swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
                        window.location = "../../folder/clientes";
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

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
