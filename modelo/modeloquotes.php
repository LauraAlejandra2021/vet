<?php
class Modelo{

  private $pet;
  private $db;

  public function __construct(){
      $this->quotes=array();
      $this->db=new PDO('mysql:host=localhost;dbname=vetdog',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT q.id, u.id, u.dni, u.nombre, 
                p.id_tiM, p.noTiM, s.id_servi, s.nomser, 
                q.title, q.nommas, q.dueno, q.color, q.start, q.end, q.estado 
                FROM quotes q
                INNER JOIN usuarios u ON q.id = u.id 
                INNER JOIN pet_type p ON q.id_tiM = p.id_tiM 
                INNER JOIN service s ON q.id_servi = s.id_servi";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->quotes[]=$tabla;
      }
      return $this->quotes;
    }
    public function  insertar(Modelo $data){
    try {
    $query="INSERT INTO quotes (id_vet, id_tiM)VALUES(?,?)";

      $this->db->prepare($query)->execute(array($data->id_vet, $data->id_tiM));

    }catch (Exception $e) {

      die($e->getMessage());
    }
    }
	
  public function actualizar($tabla,$data,$condicion){
      $consulta="UPDATE $tabla SET $data WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
  public function eliminar($tabla,$condicion){
      $consulta="DELETE FROM $tabla WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
}

 ?>
