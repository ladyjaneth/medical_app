<!-- EDITAR ROL -->
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
        <h1 style="color:blue">Editar Rol</h1>

        <!-- Bloque de Error Flash -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['error']); // Se borra para que no persista 
            ?>
        <?php endif; ?>


        <?php /** @var array $rol */ ?>
        <form method="POST" action="/actualizar-rol/<?= $rol['role_id'] ?>">
            <!-- Este es un input oculto para indicarle al back que no es un método POST(guardar) sino que es un método PUT(actualizar) -->
            <input type="hidden" name="_method" value="PUT">

            <?php /** @var array $rol */ ?>
            <div class="mb-3">

                <label for="id" class="form-label">id</label>
                <input style="cursor: not-allowed;" type="text" class="form-control" id="role_id" name="role_id" value="<?php echo $rol['role_id']; ?>" disabled>

            </div>



            <div class="mb-3">
                <?php /** @var array $name */ ?>
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $rol['name']; ?>">
            </div>


            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $rol['description']; ?></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="/roles" type="submit" class="btn btn-primary">Regresar</a>

        </form>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>

</body>

</html>