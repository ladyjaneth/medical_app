<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Editar Usuarios</title>
</head>

<body>

    <!-- FORMULARIO  -->
    <div class="container">
        <h1 style="color: blue;">Editar Usuarios</h1>
        
          <!-- Bloque de Error Flash -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['error']); // Se borra para que no persista 
            ?>
        <?php endif; ?>
        
        
        
        
        
        <form method="POST" action="/actualizar-usuarios">

            <div class="row">
                <div class="col">
                    <label for="role">Rol:</label>

                    <select class="form-control" id="doctor_id" name="role_id">
                        <option value="">Seleccione Rol...</option>


                        <?php /** @var array $roles @var array $usuario */ ?>  

                        <?php foreach ($roles as $rol): ?>
                                                                    <!-- SI EL USUARIO SELECCIONO TAL ID QUE ME MUESRE ESE ID -->
                            <option 
                                value="<?= $rol['role_id']; ?>" 
                                <?= $rol['role_id'] == $usuario['role_id'] ? 'selected' : ''; ?>
                            > 
                                <?= $rol['name']; ?>
                            </option>

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
                        <button class="btn btn-primary">Actualizar</button>
                    </div>


                </div>





            </div>


        </form>
    </div>
    <!--  -->










    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>

