<?php


//Todos los modelos (lógica/motor de la applicación) requieren accceder
//a la base de datos, esta clase, brindará este acceso.
class Conexion {

  //Atributos
  private $servidor ="localhost";
  private $puerto ="3306";
  private $baseDatos ="tiendaperu";
  private $usuario="root";
  private $clave="";

  //Método
  public function getConexion(){
    //try catch = manejador de excepciones/errores
    //try (intentar)
    //catch (accidente, error)
    try{
      //la clase PDO permite conectarse a diferentes bases de datos
      //requiere una configuaración minima y es facil de utilizar
      $pdo = new PDO(
        "mysql:host={$this->servidor}; port={$this->puerto}; dbname={$this->baseDatos}; charset=UTF8",
        $this->usuario,
        $this->clave);

      //configurar el manejo de errores de PDO
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo; 
    }catch(Exception $e){
      //cuando se suscitó un error...
      die($e->getMessage());
    }
  }
 
}