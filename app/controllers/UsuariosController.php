<?php

require_once __DIR__ . '/../services/UsuarioService.php';
require_once __DIR__ . '/../services/RolService.php';
require_once __DIR__ . '/BaseController.php';

class UsuariosController extends baseController
{

    private UsuarioService $usuarioService;
    private RolService $rolService;


    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
        $this->rolService = new RolService();
    }



    public function crearUsuario()
    {
        $rol = $this->rolService->obtenerRoles();
        $this->render('usuario/usuarios', ['roles'=> $rol]);
        
    }


    public function mostrarUsuarios(){
        $usuario = $this->usuarioService->mostrar();
        $this->render('usuario/mostrarUsuarios',['usuarios'=>$usuario]);
    }
 



    public function save(array $user)
    {
        try{
            $this->usuarioService->save($user);
            $_SESSION['success'] = 'Usuario guardado correctamente'; //mensaje de exito si todo salio bien
            header('Location: /mostrar-usuarios');
            exit; //detenemos la ejecución después de redirigir 

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage(); //mensaje de error si algo fallo
            header('Location: /usuarios');
            exit;
        }

    }
    
    //busca por el id y muestra la vista de editar
    public function editarUsuario(int $id){
        $roles = $this->rolService->obtenerRoles();
        $usuario = $this->usuarioService->buscarId($id);
        $this->render('usuario/editarUsuario', ['roles'=>$roles, 'usuario'=>$usuario]);    //TENGO QUE VER COMO PASO LOS DATOS A LAA VISTA DE EDITAR 

    }

    
    public function actualizarUsuario(int $id, array $usuario){
        $isSuccess = $this->usuarioService->actualizar($id, $usuario);

        if(!$isSuccess){
            $_SESSION['error'] = 'No se pudo actualizar el usuario. Verifica los datos';
            header(
                'Location: /actualizar-usuarios' .$id);
                exit;
        }

        $_SESSION['success'] = '¡EL usuario'.$id.'fue actualizado correctamente!';
            header(
                'Location: /usuarios/'.$id);
                exit;

    }



    public function eliminarUsuario(int $id){

        try{
           $usuario = $this->usuarioService->eliminarUsuario($id);

            if($usuario){
                header('Location: /mostrar-usuarios?mensaje=usuario_eliminado');
                exit;
            }else{
                header('Location: /mostrar-usuarios=no_encontrado');
                exit;
            } 
        }catch(Exception $e){
            header('Location: /mostrar-usuarios?error='. urlencode($e->getMessage()));
            exit;
        }



    }








   /*  public function save(array $user) 
    {
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }

        try{
            $this->usuarioService->save($user);
        }catch(Exception $e){
            $_SESSION['error']= $e->getMessage();
            header('Location: /usuarios');
            exit;
        }
    } */
}
