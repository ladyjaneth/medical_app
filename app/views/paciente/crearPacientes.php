<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>

<body>


    <div class="container">

        <h1>Crear Pacientes</h1>

        <form method="POST" action="/citas">
            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Paciente">
                </div>
                <div class="col">

                    <label>Apellidos:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Apellidos">

                </div>
            </div>



            <div class="row">
                <div class="col">

                    <label for="">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="date_of_birth" placeholder="Rango de Fechas">
                </div>

                <div class="col">
                    <label for="role">Genero:</label>
                    <select class="form-control" id="doctor_id" name="gender" [(ngModel)]="medicos.doctor_id">
                        <option value="">Seleccione Genero...</option>
                        <option value="1">M</option>
                        <option value="2">F</option>

                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="phone" placeholder="Teléfono">
                </div>
                <div class="col">

                    <label>Correo:</label>
                    <input type="text" class="form-control" name="email" placeholder="Correo">

                </div>
            </div>



            <div class="row">
                <div class="col">
                    <label>Número Documento:</label>
                    <input type="text" class="form-control" name="document_number" placeholder="Número Documento">
                </div>
                <div class="col">

                    <label>Dirección:</label>
                    <input type="text" class="form-control" name="address" placeholder="Dirección">

                </div>
            </div>



            <div class="row">
                <div class="col">
                    <button class="btn btn-primary">Guardar</button>
                </div>

            </div>


    </div>
    </form>

    </div>



    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>