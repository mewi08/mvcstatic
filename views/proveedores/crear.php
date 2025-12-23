<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Proveedores</title>
</head>
<body>
    <div class="container">
        <h1>Registro de proveedores</h1>
        <form action="" id="formulario-proveedor">
            <div class="card">
                <div class="card-header">Complete el formulario</div>
                <div class="card-body">
                    <div class="form-floating mb-2">
                        <input type="text" id="razonsocial" class="form-control" required>
                        <label for="razonsocial" class="form-label">Razón Social</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="ruc" class="form-control" required>
                        <label for="ruc" class="form-label">RUC</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="telefono" class="form-control" required>
                        <label for="telefono" class="form-label">Teléfono</label>
                    </div>

                    <div class="form-floating mb-2">
                        <select name="" id="origen" class="form-select">
                            <option value="">Selecciona</option>
                            <option value="N" class="form-select">Nacional</option>
                            <option value="E" class="form-select">Extranjero</option>
                        </select>
                        <label for="origen" class="form-label">Origen</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" id="contacto" class="form-control" required>
                        <label for="contacto" class="form-label">Contacto</label>
                    </div>
                    
                    <div class="form-floating mb-2">
                        <input type="number" min="1" max="5" value="1" id="confianza" class="form-control" required>
                        <label for="confianza" class="form-label">Confianza</label>
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
            document.querySelector("#formulario-proveedor").addEventListener("submit", function(event){
                event.preventDefault()
                if(confirm("¿Estás seguro de guardar?")){
                    guardarDatos()
                }
            })
            function guardarDatos(){
                const datos = new FormData()
                datos.append("operacion", "registrar")
                datos.append("razonsocial", document.querySelector("#razonsocial").value)
                datos.append("ruc", document.querySelector("#ruc").value)
                datos.append("telefono", document.querySelector("#telefono").value)
                datos.append("origen", document.querySelector("#origen").value)
                datos.append("contacto", document.querySelector("#contacto").value)
                datos.append("confianza", document.querySelector("#confianza").value)
                
                fetch('../../app/controllers/proveedor.controller.php',{
                    method: 'POST',
                    body: datos
                })
                .then(response => response.json())
                .then(data => { 
                //console.log(data) 
                if (data.idproveedor > 0){
                    document.querySelector("#formulario-proveedor").reset()
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
