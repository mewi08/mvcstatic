<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- container = centro l contenido -->
    <div class="container">
        <h1>Listar Productos</h1>
        <a href="./crear.php" class="btn btn-sm btn-primary">Registrar</a>
        <hr>

        <table class="table table-striped" id ="tabla-productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Clasificación</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Garantía</th>
                    <th>Ingreso</th>
                    <th>Cantidad</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contenido dinámico, viene desde la BD -->
                
            </tbody>
        </table>
    </div>

    <script>
        //Método    : Acción
        //Atributo  : Característica, propiedad
        //Evento    : Respuesta

        //Verificar que toda la pagina esté cargada (lista)
        document.addEventListener("DOMContentLoaded", function(){
            //Enviarle una solicitud al controlador y esperar una respuesta
            function obtenerDatos(){
                const datos = new FormData()
                datos.append("operacion","listar")
                //¿Qué es una promesa?
                //Conceptos ligados a procesos asíncronos, donde una tarea
                //puede ser resuelta en N tiempo o bien puede fallar
                fetch('../../app/controllers/producto.controller.php', {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => { 
                    //console.log(data) //todos los datos en un paquete                   
                    const tabla = document.querySelector("#tabla-productos tbody")
                   
                    //Renderizar las filas en <table>
                    data.forEach(element => {
                        tabla.innerHTML += `
                        <tr>
                            <td> ${element.id}</td>
                            <td> ${element.clasificacion}</td>
                            <td> ${element.marca}</td>
                            <td> ${element.descripcion}</td>
                            <td> ${element.garantia}</td>
                            <td> ${element.ingreso}</td>
                            <td> ${element.cantidad}</td>
                            <td>
                                <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
                                <a href='#' class='btn btn-sm btn-info'>Editar</a>
                            </td>
                        </tr> `;
                    });
                })
            }

            obtenerDatos()
        })
    </script>

</body>
</html>