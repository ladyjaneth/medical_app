<?php
//RUTAS
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/CitasController.php';
require_once __DIR__ . '/../app/controllers/MedicoController.php';
require_once __DIR__ . '/../app/controllers/PacientesController.php';
require_once __DIR__ . '/../app/controllers/UsuariosController.php';
require_once __DIR__ . '/../app/controllers/RolController.php';





require_once __DIR__ . '/../app/middleware/RoleMiddleware.php';
//require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';



$authController = new AuthController();
$citasController = new CitasController();

$medicoController = new MedicoController();
$pacientesController = new PacientesController();
$usuariosController = new UsuariosController();
$rolController = new RolController();


$routes = [

    'GET' => [

        '/' => function () {

            echo "HOME";
        },


        '/admin' => function () {
            RoleMiddleware::handle(['ADMIN']);
            echo 'Panel Admin';
        },


        '/citas' => function () use ($citasController) {
            /* RoleMiddleware::handle(['ADMIN', 'RECEPCIONISTA']); */
            $citasController->create();
        },


        '/mostrarcitas' => function () use ($citasController) {
            $citasController->mostrarCitas();
        },



        '/medico' => function () use ($medicoController) {
            RoleMiddleware::handle(['ADMIN', 'MEDICO']);
            $medicoController->showMedico();

            /* RoleMiddleware::handle(['MEDICO']);
            echo 'Atender cita'; */
        },


        '/pacientes' => function () use ($pacientesController) {
            $pacientesController->crearPaciente();
        },


        '/crear-rol' => function () use ($rolController) {
            $rolController->crearRol();
        },


        '/roles' => function () use ($rolController) {
            $rolController->mostraRoles();
        },


        //mostrar el formuario con los datos actuales
        '/editar-rol/{id}' => function ($id) use ($rolController) {
            $rolController->editarRol($id);
            // $rolController->editarRol($id, $_POST);
        },

        //procesar el envio del formulario



        '/usuarios' => function () use ($usuariosController) {
            $usuariosController->crearUsuario();
        },


        '/editar-usuarios/{id}'=>function($id) use($usuariosController){
            $usuariosController->editarUsuario($id);
        },


        '/mostrar-usuarios'=>function() use ($usuariosController){
            $usuariosController->mostrarUsuarios();
        },


       
        '/session-test' => function () {
            $_SESSION['user'] = [
                'id' => 1,
                'username' => 'admin',
                'role' => 'ADMIN'
            ];
            echo 'sesión creada';
        },


        '/session-view' => function () { //verificar si quedo guardada la sesion del usuario

            echo '<pre>';

            print_r($_SESSION);

            echo '</pre>';
        },





        '/login' => function () use ($authController) {
            $authController->showLogin();
        },


        '/dashboard' => function () {


            RoleMiddleware::handle(['ADMIN', 'RECEPCIONISTA', 'MEDICO']);


            switch ($_SESSION['user']['role']) {
                case 'ADMIN':
                    echo 'Dashboard Admin';
                    break;

                case 'RECEPCIONISTA':
                    echo 'Dashboard RECEPCIONISTA';
                    break;

                case 'MEDICO':
                    echo 'Dashboard Medico';
                    break;
            }
        },



        'profile' => function () {
            if (!isset($_SESSION['user'])) {
                echo 'No autenticado';
                return;
                echo 'Bienvenido';
                echo $_SESSION['user']['username'];
            }
        },


        /*  '/logout' => function () use ($authController) {
            $authController->logout();
        }, */


        //genera password hash
        '/test-password' => function () {

            echo password_hash(
                '78910',
                PASSWORD_BCRYPT
            );
        }
    ],

    'POST' => [

        '/login' => function () use ($authController) {
            $authController->login();
        },



        //$_POST
        '/guardar-roles' => function () use ($rolController) {
            $rolController->guardarRol($_POST);
        },


        //guardar usuario 
        '/guardar-usuarios' => function () use ($usuariosController) {
            $usuariosController->save($_POST);
        },


    





    ],

    'PUT' => [

        //actualizar el rol
        '/actualizar-rol/{id}' => function ($id)  use ($rolController) {
            $rolController->actualizarRol($id, $_POST);
        },


         '/actualizar-usuario/{id}'=>function($id) use($usuariosController){
            $usuariosController->actualizarUsuario($id, $_POST);
        }

    ],



    'DELETE' => [
        '/eliminar-rol/{id}' => function ($id) use ($rolController) {
            $rolController->eliminarRol($id);
        },


        '/eliminar-usuario/{id}' => function($id) use ($usuariosController){
                    $usuariosController->eliminarUsuario($id);
        }




    ]







];
