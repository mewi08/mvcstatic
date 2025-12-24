<!DOCTYPE html>
<html lang="en">
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
            <label for="descripcion">Descripcion</label>
            <input type="text" id="descripcion" class="form-control">
            </div>
        </form>
        <hr>
        <h3>Búsqueda por Marca</h3>
        <form action="" id="form-busqueda-2">
            <div class="input-group">
                <select id="marcas" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="Epson">Epson</option>
                    <option value="Logitech">Logitech</option>
                    <option value="Canon">Canon</option>
                    <option value="LG">LG</option>
                    <option value="Microsoft">Microsoft</option>
                </select>
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>
        </form>
        <table class="table table-bordered mt-3" id="tabla-productos">
            <thead>
                <th>ID</th>
                <th>Descripción</th>
                <th>Garantía</th>
                <th>Cantidad</th>
            </thead>
            <tbody>
                <!-- Registros -->
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            function buscarProductoID(){
                const datos = new FormData()
                datos.append("operacion", "buscarPorId")
                datos.append("id", document.querySelector("#idbuscado").value)
                
                fetch('../../app/controllers/producto.controller.php',{
                    method: 'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then(data =>{
                        const resultado = data[0]['descripcion'] + " " +data[0]['marca']
                        document.querySelector("#descripcion").value = resultado
                    })
                    .catch(error=>{
                        document.querySelector("#descripcion").value= ""
                        alert("No se encontro")
                    });
                    
            }

            function buscarProductoMarca(){
                const datos = new FormData()
                datos.append("operacion", "buscarPorMarca")
                datos.append("marca", document.querySelector("#marcas").value)

                fetch('../../app/controllers/producto.controller.php',{
                    method: 'POST',
                    body: datos
                })
                    .then(response => response.json())
                    .then(data =>{
                        const tabla = document.querySelector("#tabla-productos tbody")
                        data.forEach(element => {
                            tabla.innerHTML = "";
                            tabla.innerHTML+=`
                            <tr>
                                <td> ${element.id}</td>
                                <td> ${element.descripcion}</td>
                                <td> ${element.garantia}</td>
                                <td> ${element.cantidad}</td>
                            </tr> `;
                        });
                    })
            }

            document.querySelector("#form-busqueda-1").addEventListener("submit", function(event){
                event.preventDefault()

                buscarProductoID();
            })
            document.querySelector("#form-busqueda-2").addEventListener("submit", function(event){
                event.preventDefault()
                buscarProductoMarca()
            })
        })
    </script>
</body>
</html>