<?php
//requerimos de la conexion
require_once "Conexion.php";

//Herencia (Conexion sede su método a Producto )
class Producto extends Conexion {

  //Este atributo contendrá la conexion
  private $pdo;

  //Constructor
  public function __construct(){
    //La conexión asigna el acceso a $this->pdo
    $this->pdo = parent::getConexion();
  }

  //Nota:
    //El dato de retorno siempre está al lado derecho de los dos puntos
    // Todo procedimiento que acceda a una base de datos es susceptible a errores
      // por ello se utiliza el bloque try catch
    //El execute() está vacío cuando no hay comodines

  //¿Qué funciones podemos realizar?
  public function listar(): array{
      //El dato de retorno es un arreglo
    try{
      //1. Crear la consulta SLQ
      $sql = "
      SELECT 
        id,clasificacion, marca, descripcion, garantia, ingreso, cantidad
        FROM productos
        ORDER BY id DESC
      ";
      //2. Enviar la consulta preparada a PDO
      $consulta = $this->pdo->prepare($sql);
      //3. Ejecutar la consulta
      $consulta->execute();
      //4. Entregar resultados
      //fetchAll = colección de arreglos
      //PDO::FETCH_ASSOC = los valores son asociativos
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      return [];
    }
  }
//El dato de retorno es un entero (int)
//Al ser autoincremental siempre sera mayor o igual a 1
  public function registrar($registro = []): int{
    try{
      //Los comodines, poseen índices(arreglos)
      $sql = "
      INSERT INTO productos
        (clasificacion, marca, descripcion, garantia, ingreso, cantidad)
        VALUES (?,?,?,?,?,?)
      ";
      $consulta = $this->pdo->prepare($sql);

      //La consulta, lleva comodines, pasamos los datos en execute()
      $consulta->execute(
        array(
          $registro['clasificacion'],
          $registro['marca'],
          $registro['descripcion'],
          $registro['garantia'],
          $registro['ingreso'],
          $registro['cantidad']
        )
      );

      //Retornar la PK (primary key) generada
      return $this->pdo->lastInsertId();             
    }catch(Exception $e){
      return -1;
    }
  }

  public function eliminar($id): int{
    try{
      $sql = "DELETE FROM productos WHERE id=?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(
        array($id)
      );
      //¿Qué debemos devolver?
      //Retorna la cantidad de filas afectadas -> rowCount()
      return $consulta->rowCount(); 
    }catch(Exception $e){
     return -1;
    }
  }

  public function actualizar($registro = []):int{
    try{
      //Los comodines, poseen índices(arreglos)
      $sql = "
      UPDATE productos SET 
        clasificacion = ?, 
        marca = ?, 
        descripcion = ?, 
        garantia = ?, 
        ingreso = ?, 
        cantidad = ?,
        updated = now()
      WHERE id = ?
      ";
      $consulta = $this->pdo->prepare($sql);

      //La consulta, lleva comodines, pasamos los datos en execute()
      $consulta->execute(
        array(
          $registro['clasificacion'],
          $registro['marca'],
          $registro['descripcion'],
          $registro['garantia'],
          $registro['ingreso'],
          $registro['cantidad'],
          $registro['id']
        )
      );

      //¿Cuántos registros fueron afectados?
      return $consulta->rowCount();            
    }catch(Exception $e){
      return -1;
    }
  }

  public function buscar(){

  }
 

}