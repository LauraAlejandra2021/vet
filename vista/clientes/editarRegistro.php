<?php
require_once '../../assets/db/config.php';

    session_start();
    if(isset($_POST['update'])){
        $database = new Database();
        $db = $database->open();
        try{
            $id = $_GET['id'];
            
            $dni_due  = $_POST['dni_due'];
            $nom_due =htmlspecialchars($_POST['nom_due']);
            $ape_due =htmlspecialchars($_POST['ape_due']);
            $movil = $_POST['movil'];
            $fijo = $_POST['fijo'];
            $correo = $_POST['correo'];
            $direc = $_POST['direc'];
           
            
$sql = "UPDATE owner SET dni_due = '$dni_due', nom_due = '$nom_due', ape_due = '$ape_due', movil = '$movil', fijo = '$fijo',correo = '$correo',direc = '$direc' WHERE  id_due  = '$id'";
            //if-else statement in executing our query
            $_SESSION['message'] = ( $db->exec($sql) ) ? 'Cliente actualizado correctamente' : 'No se puso actualizar el cliente';

        }
        catch(PDOException $e){
            $_SESSION['message'] = $e->getMessage();
        }

        //Cerrar la conexión
        $database->close();
    }
    else{
        $_SESSION['message'] = 'Complete el formulario de edición';
    }

    header('location: ../../folder/clientes');

?>