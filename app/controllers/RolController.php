<?php
//CONTROLADROR 
require_once __DIR__ . '/../services/RolService.php';
require_once __DIR__ . '/BaseController.php';


class RolController extends BaseController
{

    private RolService $rolService;

    public function __construct()
    {
        $this->rolService = new RolService();
    }


    

    public function mostraRoles()
    {
        $roles = $this->rolService->obtenerRoles();  //llamas a la funcion del servicio que te trae los roles
        $this->render('roles/mostrarRol', ['roles' => $roles]); //le envias el arreglo real a la vista
    }

    public function crearRol()
    {
        $this->render('roles/crearRol');
    }

    public function editarRol(int $id)
    {
        $rol = $this->rolService->buscarId($id);
        $this->render('roles/editarRol', ['rol' => $rol]);
    }


    public function actualizarRol(int $id, array $role)
    {
        /* if (session_status() === PHP_SESSION_NONE) { //las sesiones estan habilitadas pero no se ha iniciado una session
            session_start();                       //se inicia la session
        } */
        //el cuerpo del formulario siempre es una array asociativo
        $isSuccess = $this->rolService->actualizaRol($id, $role);

        if (!$isSuccess) {
            $_SESSION['error'] = 'No se pudo actualizar el Rol.Verifica los datos';
            header(
                'Location: /actualizar-rol/' . $id);
            exit;
        }

        //si tuvo exito
        $_SESSION['success'] = '¡El Rol ' . $id . ' fue actualizado correctamente!';
        header(
            'Location: /roles');
        exit;
    }


    public function guardarRol(array $rol)
    {  //recibe como parámetro un arreglo con los datos del formulario

        //asegurar que la sesion este iniciada 
        if (session_status() === PHP_SESSION_NONE) { //las sesiones estan habilitadas pero no se ha iniciado una session
            session_start();                       //se inicia la session
        }

        try {

            $roleId = $this->rolService->guardarRole($rol); //pasándole los datos recibidos.

            if (!$roleId) {
                $_SESSION['error'] = 'No se pudo guardar el Rol.Verifica los datos';
                header(
                    'Location: /crear-rol'
                );

                exit;
            }

            //si tuvo exito
            $_SESSION['success'] = '¡El Rol fue creado correctamente!';
            header(
                'Location: /roles'
            );

            exit;
        } catch (Exception $e) {

            $_SESSION['error'] = $e->getMessage();

            header('Location: /crear-rol');
        }
    }


    public function eliminarRol(int $id)
    {

        try { //l especialista hace su magia en la base de datos y le responde con un Sí (True) o un No (False), que se guarda en la variable $roles
            $roles = $this->rolService->eliminarRole($id);

            if ($roles) {
                header('Location: /roles?mensaje=rol_eliminado');
                exit;
            } else {
                header('Location: /roles?error=no_encontrado');
                exit;
            }
        } catch (Exception $e) {
            header('Location: /roles?error=' . urlencode($e->getMessage()));
            exit;
        }
    }
}
