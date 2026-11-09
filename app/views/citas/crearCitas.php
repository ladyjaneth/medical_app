<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Citas</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">


</head>

<body>


    <div class="container">

        <h1 style="color: blue;">Crear Citas</h1>

        <form method="POST" action="">
            <div class="row">
                <div class="col">
                    <label for="role">Paciente:</label>

                    <select class="form-control" id="doctor_id" name="patient_id">
                        <option value="">Selecciona un Paciente</option>


                        <?php /** @var array $pacientes */ ?>
                        <?php foreach ($pacientes as $paciente): ?>

                            <option value="<?php echo $paciente['patient_id']; ?>"><?php echo $paciente['first_name'] . ' ' . $paciente['last_name']; ?></option>

                    </select>
                <?php endforeach; ?>


                </div>


                <div class="col">
                    <label for="role">Médico:</label>
                    <select class="form-control" id="doctor_id" name="doctor_id">
                        <option value="">Seleccione un Médico...</option>

                        <?php /** @var array $medicos */ ?>

                        <?php foreach ($medicos as $medico): ?>

                            <option value="<?php echo $medico['doctor_id']; ?>"><?php echo $medico['first_name'] . ' ' . $medico['last_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>


            <div class="row">

                <div class="col">
                    <label for="">Fecha de Agendamiento:</label>
                    <input type="date" class="form-control" name="scheduled_at" placeholder="fecha y hora">

                </div>

                <div class="col">
                    <label for="">Id usuario:</label>
                    <input type="text" class="form-control" name="scheduled_at" placeholder="Id usuario">

                </div>

            </div>


            <div class="row">
                <div class="col">
                    <label for="">Motivo:</label>
                    <textarea rows="4" class="form-control" name="reason" cols="50" placeholder="Escribe tu texto aquí..."></textarea>

                </div>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
            <br>





        </form>

    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>