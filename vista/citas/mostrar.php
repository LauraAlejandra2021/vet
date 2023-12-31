﻿<?php
include __DIR__ . '../../../assets/db/config.php';
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
    <link href="../assets/css/fullcalendar.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/lll.png" />


</head>

<body class="theme-red">
    <!-- Loading -->
    <?php include_once __DIR__ . '../../commons/loading.php'; ?>

    <!-- Header -->
    <?php include_once __DIR__ . '../../commons/header.php'; ?>

    <!-- Menu -->
    <?php include_once __DIR__ . '../../menu.php'; ?>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Listado de las citas rapidas :
                            </h2><br>


                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>DUEÑO</th>
                                            <th>VETERINARIO</th>
                                            <th>CITA</th>
                                            <th>MASCOTA</th>
                                            <th>TIPO</th>
                                            <th>SERVICIO</th>
                                            <th>INCIO</th>
                                            <th>FIN</th>

                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($dato as $key => $value) {
                                            foreach ($value as $va) { ?>
                                                <tr>
                                                    <td><?php echo $va['id']; ?></td>
                                                    <td><?php echo $va['dueno']; ?></td>
                                                    <td><?php echo $va['nombre']; ?></td>
                                                    <td><?php echo $va['title']; ?></td>
                                                    <td><?php echo $va['nommas']; ?></td>
                                                    <td><?php echo $va['noTiM']; ?></td>
                                                    <td><?php echo $va['nomser']; ?></td>
                                                    <td><?php echo $va['start']; ?></td>
                                                    <td><?php echo $va['end']; ?></td>


                                                    <td class="text-center"><?php

                                                        if ($va['estado'] == 1) { ?>
                                                            <form method="get" action="javascript:activo('<?php echo $va['id']; ?>')">

                                                                <span class="label label-success">Aceptado</span>
                                                            </form>
                                                        <?php  } else { ?>

                                                            <form method="get" action="javascript:inactivo('<?php echo $va['id']; ?>')">
                                                                <button type="submit" class="btn btn-danger btn-xs">Pendiente</button>
                                                            </form>
                                                        <?php  } ?>
                                                    </td>

                                                    <td class="text-center"><a type="button" href="../vista/citas/edit?id=<?php echo $va["id"]; ?>" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">edit</i>
                                                        </a>



                                                </tr>

                                        <?php
                                            }
                                        }
                                        ?>

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

    <!--=============================================================CONTENIDO DE LA PÁGINA =============================================================-->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CALENDARIO DE CITAS RÁPIDAS:
                            </h2><br>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <?php
                                try {
                                    $bd = new Database();

                                    $bdd = $bd->open();
                                } catch (Exception $e) {
                                    die('Error : ' . $e->getMessage());
                                }
                                $sql = "SELECT id, id_vet,id_tiM,id_servi, title, nommas, dueno, start, end, color FROM quotes";

                                $req = $bdd->prepare($sql);
                                $req->execute();

                                $events = $req->fetchAll();
                                ?>
                                <div id="calendar">
                                </div>

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
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

    <script src="../assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="../assets/js/fullcalendar/fullcalendar.js"></script>
    <script src="../assets/js/fullcalendar/locale/es.js"></script>

    <!--------------------------------script edit cate----------------------------->



    <script>
        $(document).ready(function() {

            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

            $('#calendar').fullCalendar({
                header: {
                    language: 'es',
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',

                },
                defaultDate: yyyy + "-" + mm + "-" + dd,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function(start, end) {

                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                },
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                    edit(event);

                },
                events: [
                    <?php foreach ($events as $event) :

                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if ($start[1] == '00:00:00') {
                            $start = $start[0];
                        } else {
                            $start = $event['start'];
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event['end'];
                        }
                    ?> {
                            id: '<?php echo $event['id']; ?>',
                            id_vet: '<?php echo $event['id_vet']; ?>',
                            id_tiM: '<?php echo $event['id_tiM']; ?>',
                            id_servi: '<?php echo $event['id_servi']; ?>',
                            title: '<?php echo $event['title']; ?>',
                            nommas: '<?php echo $event['nommas']; ?>',
                            dueno: '<?php echo $event['dueno']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            color: '<?php echo $event['color']; ?>',
                        },
                    <?php endforeach; ?>
                ]
            });

            function edit(event) {
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }

                id = event.id;

                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                    url: 'editEventDate.php',
                    type: "POST",
                    data: {
                        Event: Event
                    },
                    success: function(rep) {
                        if (rep == 'OK') {
                            alert('Evento se ha guardado correctamente');
                        } else {
                            alert('No se pudo guardar. Inténtalo de nuevo.');
                        }
                    }
                });
            }

        });
    </script>

    <script>
        // Editar estado inactivo
        function inactivo(id) {
            var id = id;
            $.ajax({
                type: "GET",
                url: "../assets/ajax/editar_estado_inactivo_cita.php?id=" + id,
            }).done(function(data) {
                window.location.href = 'citas';
            })
        }
    </script>
</body>

</html>