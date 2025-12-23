<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- container = centro 1 contenido -->
    <div class="container">
        <h1>Listar Proveedores</h1>
        <a href="./crear.php" class="btn btn-sm btn-primary">Registrar</a>
        <hr>
        <table class="table table-striped" id="tabla-proveedores">
            <thead>
                <th>ID</th>
                <th>Razón Social</th>
                <th>RUC</th>
                <th>Teléfono</th>
                <th>Origen</th>
                <th>Contacto</th>
                <th>Confianza</th>
                <th>Operaciones</th>
            </thead>
            <tbody>
                <!-- Contenido dinámico, viene desde la BD -->
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            function obtenerDatos(){
                const datos = new FormData()
                datos.append("operacion", "listar")
                fetch('../../app/controllers/proveedor.controller.php',{
                    method: 'POST',
                    body: datos
                })
                .then(response=> response.json())
                .then(data=>{
                    const tabla = document.querySelector("#tabla-proveedores tbody")
                    
                    data.forEach(element => {
                        tabla.innerHTML+=`
                        <tr>
                            <td>${element.idprov}</td>
                            <td>${element.razonsocial}</td>
                            <td>${element.ruc}</td>
                            <td>${element.telefono}</td>
                            <td>${element.origen}</td>
                            <td>${element.contacto}</td>
                            <td>${element.confianza}</td>
                            <td>
                                <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
                                <a href='#' class='btn btn-sm btn-info'>Editar</a>
                            </td>
                        </tr>
                        `
                    });
                })
            }
            obtenerDatos()
        })
    </script>
</body>
</html>