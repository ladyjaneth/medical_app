<?php
//asegurar que la sesion este iniciada 
if (session_status() === PHP_SESSION_NONE) { //las sesiones estan habilitadas pero no se ha iniciado una session
    session_start();                       //se inicia la session
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Rol</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <h1 style="color:blue">Crear Rol</h1>

        <!-- Bloque de Error Flash -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['error']); // Se borra para que no persista 
            ?>
        <?php endif; ?>



        <form method="POST" action="/guardar-roles">
            <div class="mb-3">

                <label for="disabledSelect" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="name">

            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="/roles"  type="submit" class="btn btn-primary">Regresar</a>
        </form>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>

</body>

</html>