<!--  VISTA MOSTRAR-ROL-->

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
    <title>Mostrar Roles</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>




<body>

    <div class="container">

        <h1 style="color: #340fec;">Mostrar Roles</h1>

        <!-- MENSAJE DE EXITO verde, Bloque de Éxito Flash -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['success']); // Se borra tras mostrarse una vez 
            ?>
        <?php endif; ?>


            <!-- Agrega este bloque de código en la parte donde quieras que aparezca la alerta  -->
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'rol_eliminado'): ?>
            <div id="alerta-mensaje" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px;">
                ¡El rol se ha eliminado exitosamente!
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
                Error: <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>


            <!-- TABLA -->
        <table style="text-align: center;" class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Role id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Estados</th>


                </tr>
            </thead>
            <tbody>

                <?php /** @var array $roles */ ?>

                <?php foreach ($roles as $rol): ?> <!-- foreach de roles -->

                    <td><?= ($rol['role_id']) ?></td>
                    <td><?= ($rol['name']) ?></td>
                    <td><?= ($rol['description']) ?></td>
                  
                    <td>

                        <!-- <a href="/crear-rol" class="btn btn-primary">Crear</a> -->
                        <a href="/editar-rol/<?= ($rol['role_id']) ?>" class="btn btn-sm btn-warning">Editar</a>

                        <!--   para el boton de eliminar debo crear un form para este boton y enviarlo por el metodo pOST -->
                        <form action="/eliminar-rol/<?= ($rol['role_id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar el rol? <?= ($rol['role_id']) ?>' );">
                            <input type="hidden" name='_method' value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>


                    </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>


        </table>

        <div class="row">
            <div class="col">

                <a href="/crear-rol" class="btn btn-primary">Crear</a>

            </div>

        </div>


    </div>


    <script src="/js/bootstrap.bundle.min.js"></script>


    <!-- Limpiar la URL con JavaScript (Evita que reaparezca al recargar el mensaje cuando recarguen) -->
    <script>
        if (window.history.replaceState) {
            // Limpia los parámetros GET de la URL sin recargar la página
            const urlSinParametros = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({
                path: urlSinParametros
            }, '', urlSinParametros);
        }
    </script>



</body>


</html>