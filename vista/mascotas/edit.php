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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MODIFICAR ANIMALES
                                <small>Modificar cualquier animal...</small>
                            </h2>
                        </div>

                        <div class="body">
                            <?php
                            $db = new Database();
                            $con = $db->getMysqli();
                            $id = $_GET['id'];
                            $sql = "SELECT pet.id_pet, pet.nomas, pet_type.id_tiM, pet_type.noTiM, raza.id_raza, raza.nomraza, pet.sexo, pet.edad, pet.tamano, pet.peso, owner.id_due, owner.dni_due, owner.nom_due, owner.ape_due, owner.movil, owner.fijo, owner.correo, owner.direc, pet.obser, pet.estado, pet.fere FROM pet INNER JOIN pet_type ON pet.id_tiM =  pet_type.id_tiM INNER JOIN raza ON pet.id_raza =raza.id_raza INNER JOIN owner ON pet.id_due = owner.id_due  WHERE id_pet= '$id'";
                            $query  = $con->query($sql);
                            $data =  array();
                            if ($query) {
                                while ($r = $query->fetch_object()) {
                                    $data[] = $r;
                                }
                            }

                            ?>
                            <?php if (count($data) > 0) : ?>
                                <?php foreach ($data as $d) : ?>
                                    <form method="POST" autocomplete="off" action="editarRegistro?id=<?php echo $d->id_pet; ?>">
                                        <div class="row clearfix">

                                            <div class="col-sm-4">
                                                <label class="control-label">Nombre de la mascota</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="nomas" value="<?php echo $d->nomas; ?>" class="form-control" placeholder="Nombre de la mascota..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Sexo de la mascota</label>
                                                <select name="sexo" class="form-control show-tick">
                                                    <option value="<?php echo $d->sexo; ?>"><?php echo $d->sexo; ?></option>
                                                    <option value="Macho">Macho</option>
                                                    <option value="Hembra">Hembra</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Edad de la mascota</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="<?php echo $d->edad; ?>" name="edad" required class="form-control" placeholder="Edad de la mascota..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Dueño de la mascota</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick" name="id_due">
                                                            <option value="<?php echo $d->id_due; ?>"><?php echo $d->nom_due; ?></option>
                                                            <?php
                                                            try {
                                                                $dbcon = $db->open();
                                                                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            } catch (PDOException $ex) {

                                                                die($ex->getMessage());
                                                            }
                                                            $stmt = $dbcon->prepare('SELECT * FROM owner');
                                                            $stmt->execute();

                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                extract($row);
                                                            ?>
                                                                <option value="<?php echo $id_due; ?>"><?php echo $nom_due; ?>&nbsp;<?php echo $ape_due; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Tamaño de la mascota</label>
                                                <select name="tamano" class="form-control show-tick">
                                                    <option value="<?php echo $d->tamano; ?>"><?php echo $d->tamano; ?></option>
                                                    <option value="Pequeña">Pequeña</option>
                                                    <option value="Grande">Grande</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="control-label">Peso de la mascota</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="<?php echo $d->peso; ?>" name="peso" maxlength="6" required class="form-control" placeholder="Peso de la mascota..." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <label class="control-label">Observaciones de la mascota</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea rows="4" value="<?php echo $d->obser; ?>" name="obser" class="form-control no-resize" placeholder="Observaciones..."><?php echo $d->obser; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="container-fluid" align="center">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                <a type="button" href="../../folder/mascotas" class="btn bg-red"><i class="material-icons">cancel</i> CANCELAR </a>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">


                                                <button class="btn bg-green" name="update">ACTUALIZAR<i class="material-icons">save</i></button>
                                            </div>

                                        </div>
                                    </form>
                        </div>
                    <?php endforeach; ?>

                <?php else : ?>
                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                        No hay datos
                    </span>
                <?php endif; ?>
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

</body>

</html>