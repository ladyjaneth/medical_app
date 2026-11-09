<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Usuarios</title>
</head>

<body>

    <!-- FORMULARIO  -->
    <div class="container">
        <h1 style="color: blue;">Crear Usuarios</h1>
        
          <!-- Bloque de Error Flash -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['error']); // Se borra para que no persista 
            ?>
        <?php endif; ?>
        
        
        
        
        
        <form method="POST" action="/guardar-usuarios">

            <div class="row">
                <div class="col">
                    <label for="role">Rol:</label>

                    <select class="form-control" id="doctor_id" name="role_id">
                        <option value="">Seleccione Rol...</option>


                        <?php /** @var array $roles */ ?>

                        <?php foreach ($roles as $rol): ?>

                            <option value="<?= $rol['role_id']; ?>"><?= $rol['name']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="">Nombre del Usuario:</label>
                    <input type="text" class="form-control" name="username" placeholder="Nombre del Usuario">

                </div>
            </div>


            <div class="row">

                <div class="col">
                    <label for="">Correo:</label>
                    <input type="email" class="form-control" name="email" placeholder="Correo">

                </div>

                <div class="col">
                    <label for="">Contraseña:</label>
                    <input type="text" class="form-control" name="password" placeholder="Contraseña">
                    <br>
                </div>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary">Guardar</button>
                    </div>


                </div>





            </div>


        </form>
    </div>
    <!--  -->










    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>