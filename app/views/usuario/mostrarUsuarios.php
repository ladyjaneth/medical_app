<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Usuarios</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>

    <!-- TABLA -->
    <div class="container">

        <h1 style="color: blue;">
            Mostrar Usuarios
        </h1>

<?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success">¡Usuario eliminado correctamente!</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Error: <?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>



        <table style="text-align: center;" class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">User_id</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Estados</th>

                </tr>
            </thead>
            <tbody>

                <?php /** @var array $usuarios */ ?>

                <?php foreach ($usuarios as $usuario): ?>

                    <tr>
                        <th scope="row"><?= $usuario['user_id'] ?></th>
                        <td><?= $usuario['nombre_rol'] ?></td>
                        <td><?= $usuario['username'] ?></td>
                        <td><?= $usuario['email'] ?></td>
                        <td><?= $usuario['status'] ?></td>
                        <td><?= $usuario['created_at'] ?></td>

                        <td>
                            <a href="/editar-usuarios/<?= ($usuario['user_id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <!--   para el boton de eliminar debo crear un form para este boton y enviarlo por el metodo pOST -->
                            <form action="/eliminar-usuario/<?= ($usuario['user_id'])  ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Esta seguro que deseas eliminar el usuario?<?= $usuario['user_id'] ?>');">
                                <input type="hidden" name='_method' value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>

                        </td>

                    <?php endforeach; ?>
                    </tr>



            </tbody>
        </table>


        <a class="btn btn-primary" href="/usuarios">regresar</a>

    </div>








    <script src="/js/bootstrap.bundle.min.js"></script>

</body>

</html>