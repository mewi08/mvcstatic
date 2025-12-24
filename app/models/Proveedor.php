<?php

//1. Acceder a la conexión
require_once "Conexion.php";

//2. El proveedor heredará las funcionalidades de la clase conexión
class Proveedor extends Conexion {
  
 //3. Creamos un atributo donde guardamos la conexion
 private $pdo;

 //4. En el constructor, guardamos la conexión activa
  public function __construct(){
    $this->pdo = parent::getConexion();
  }

  public function listar(): array{

    try{
    $sql= "
      SELECT idprov, razonsocial, ruc, telefono, origen, contacto, confianza 
      FROM proveedores 
      ORDER BY idprov DESC";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      return [];
    }
  }
    
  public function registrar($registro = []):int{
    try{
      $sql ="
        INSERT INTO proveedores (razonsocial, ruc, telefono, origen, contacto, confianza)
        VALUES (?,?,?,?,?,?)";

        $consulta = $this->pdo->prepare($sql);

        $consulta->execute(
          array(
            $registro ["razonsocial"],
            $registro ["ruc"],
            $registro ["telefono"],
            $registro ["origen"],
            $registro ["contacto"],
            $registro ["confianza"]
          )
        );
        return $this->pdo->lastInsertId();
    }
    catch(Exception $e){
      return -1;
    }
  }

  public function eliminar($id): int{
    try{
      $sql = "
        DELETE FROM proveedores WHERE idprov=?
      
      ";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(
        array($id)

      );

      return $consulta->rowCount();
    }catch(Exception $e){
      return -1;
    }

  }

 public function actualizar($registro =[]){
    try{
      $sql ="
        UPDATE proveedores SET 
          razonsocial=?, 
          ruc=?, 
          telefono=?,
          origen=?, 
          contacto=?, 
          confianza=?,
          updated= now()
        WHERE idprov=?";

        $consulta = $this->pdo->prepare($sql);

        $consulta->execute(
          array(
            $registro ["razonsocial"],
            $registro ["ruc"],
            $registro ["telefono"],
            $registro ["origen"],
            $registro ["contacto"],
            $registro ["confianza"],
            $registro ["idprov"] 
          )
        );

        return $consulta->rowCount();
    }
    catch(Exception $e){
      return -1;
    }
  }
  public function buscarPorId(int $id): array{
    
    try{
    $sql= "SELECT * FROM proveedores WHERE idprov=?";

      $consulta = $this->pdo->prepare($sql);

      $consulta->execute(array($id));

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  public function buscarPorOrigen(string $origen): array{
    try{
      $sql= "SELECT * FROM proveedores WHERE origen=?";

      $consulta = $this->pdo->prepare($sql);

      $consulta->execute(array($origen));

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function buscarPorConfianza(int $confianza){
    try{
      $sql= "SELECT * FROM proveedores WHERE confianza=?";

      $consulta = $this->pdo->prepare($sql);

      $consulta->execute(array($confianza));

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}