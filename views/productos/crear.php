<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Registro de productos</h1>
        <form action="" id="formulario-producto">
            <div class="card">
                <div class="card-header">Complete el formulario</div>
                <div class="card-body">
                <!-- formulario de registro -->
                    <div class="form-floating mb-2">
                        <select name="" id="clasificacion" class="form-select" required>
                            <option value="">Selecciona</option>
                            <option value="Equipo">Equipo</option>
                            <option value="Accesorios">Accesorios</option>
                            <option value="Consumibles">Consumibles</option>
                        </select>
                        <label for="clasificacion" class="form-label">Clasificación</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="marca" class="form-control" required>
                        <label for="marca" class="form-label">Marca</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="descripcion" class="form-control" required>
                        <label for="descripcion" class="form-label">Descripción</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="number" min="0" max="36" value="12" id="garantia" class="form-control" required>
                        <label for="garantia" class="form-label">Garantia</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="date" id="ingreso" class="form-control" required>
                        <label for="ingreso" class="form-label">Fecha de ingreso</label>
                    </div>

                     <div class="form-floating mb-2">
                        <input type="number" min="1" max="100" value="1" id="cantidad" class="form-control" required>
                        <label for="cantidad" class="form-label">Cantidad</label>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){

            //Detener el envio automático del formulario
            document.querySelector("#formulario-producto").addEventListener("submit", function(event){
                event.preventDefault()
                if(confirm("¿Está seguro de guardar?")){
                    guardarDatos()
                }
            })

            function guardarDatos(){
                const datos = new FormData()
                datos.append("operacion", "registrar")
                datos.append("clasificacion", document.querySelector("#clasificacion").value)
                datos.append("marca", document.querySelector("#marca").value)
                datos.append("descripcion", document.querySelector("#descripcion").value)
                datos.append("garantia", document.querySelector("#garantia").value)
                datos.append("ingreso", document.querySelector("#ingreso").value)
                datos.append("cantidad", document.querySelector("#cantidad").value)
                
                fetch('../../app/controllers/producto.controller.php', {
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => { 
                //console.log(data) 
                if (data.id > 0){
                    document.querySelector("#formulario-producto").reset()
                    alert("Datos guardados correctamente...")
                }else{
                    alert("No se pudo concretar el proceso")
                }
                })

            }
        })
    </script>
</body>
</html>