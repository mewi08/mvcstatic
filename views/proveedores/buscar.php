<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <!-- Estilos boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- Botones boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">
        <h3>Búsqueda por ID</h3>
        <form action="" id="form-busqueda-1">
            <div class="mb-3">
                <label for="idbuscado">ID Buscado</label>
                <div class="input-group">
                    <span class="input-group-text">Ingrese solo números</span>
                    <input type="text" class="form-control" id="idbuscado" autofocus>
                    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
                </div>
                <div>
                    <label for="razonsocial">Razón Social</label>
                    <input type="text" id="razonsocial" class="form-control">
                </div>
            </div>
        </form>
        <hr>
        <h3>Búsqueda por Origen</h3>
        <form action="" id="form-busqueda-2">
            <div class="input-group">
                <select id="origen" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="N">Nacional</option>
                    <option value="E">Extranjero</option>
                </select>
                 <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>
            <table class="table table-bordered mt-3" id="tabla-proveedores-1">
                <thead>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>RUC</th>
                    <th>Teléfono</th>
                    <th>Contacto</th>
                </thead>
                <tbody>
                    <!-- Registros -->
                </tbody>
            </table>
        </form>
        <hr>
        <h3>Búsqueda por Confianza</h3>
        <form action="" id="form-busqueda-3">
            <label for="nivelConfianza">Nivel Confianza</label>
            <div class="input-group">
                <input type="number" min="1" max="5" value="1" id="nivelConfianza" class="form-control">
                 <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>
            <table class="table table-bordered mt-3" id="tabla-proveedores-2">
                <thead>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>RUC</th>
                    <th>Teléfono</th>
                    <th>Contacto</th>
                </thead>
                <tbody>
                    <!-- Registros -->
                </tbody>
            </table>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            function buscarProveedorID(){
                const datos = new FormData()
                datos.append("operacion","buscarPorId")
                datos.append("idprov",document.querySelector("#idbuscado").value)
                fetch('../../app/controllers/proveedor.controller.php',{
                    method: 'POST',
                    body:datos
                })
                    .then(response =>response.json())
                    .then(data =>{
                        const resultado = data[0]['razonsocial']
                        document.querySelector("#razonsocial").value = resultado
                    })
                    .catch(error =>{
                        document.querySelector("#razonsocial").value = ""
                        alert("No se encontro")
                    })
            }

            function obtenerProveedorOrigen(){
                const datos = new FormData()
                datos.append("operacion","buscarPorOrigen")
                datos.append("origen", document.querySelector("#origen").value)
                fetch('../../app/controllers/proveedor.controller.php',{
                    method: 'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then(data=>{
                        const tabla = document.querySelector("#tabla-proveedores-1 tbody")
                        tabla.innerHTML=""
                        data.forEach(element => {
                            tabla.innerHTML +=`
                            <tr>
                                <td>${element.idprov}</td>
                                <td>${element.razonsocial}</td>
                                <td>${element.ruc}</td>
                                <td>${element.telefono}</td>
                                <td>${element.contacto}</td>
                            </tr>`
                        });
                    })
            }

            function obtenerProveedorConfianza(){
                const datos = new FormData()
                datos.append("operacion","buscarPorConfianza")
                datos.append("nivelConfianza", document.querySelector("#nivelConfianza").value)
                fetch('../../app/controllers/proveedor.controller.php',{
                    method: 'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then(data=>{
                        const tabla = document.querySelector("#tabla-proveedores-2 tbody")
                        tabla.innerHTML=""
                        data.forEach(element => {
                            tabla.innerHTML +=`
                            <tr>
                                <td>${element.idprov}</td>
                                <td>${element.razonsocial}</td>
                                <td>${element.ruc}</td>
                                <td>${element.telefono}</td>
                                <td>${element.contacto}</td>
                            </tr>`
                        });
                    })
            }

            document.querySelector("#form-busqueda-1").addEventListener("submit",function(event){
                event.preventDefault()
                buscarProveedorID();
            })

            document.querySelector("#form-busqueda-2").addEventListener("submit", function(event){
                event.preventDefault()
                obtenerProveedorOrigen();
            })

            document.querySelector("#form-busqueda-3").addEventListener("submit", function(event){
                event.preventDefault()
                obtenerProveedorConfianza();
            })
        })
    </script>
</body>
</html>