<?php

require_once __DIR__ . '/../repositories/UserRepository.php';


class UsuarioService
{

    private UserRepository $userRepository;


    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }



    public function mostrar()
    {
        return $this->userRepository->mostrarusuario();
    }



    public function save(array $user)
    {
        $user['password_hash'] = password_hash($user['password'], PASSWORD_BCRYPT);
        $this->userRepository->save($user);
    }


    public function buscarId(int $id){
        return $this->userRepository->buscarId($id);
    }



    public function actualizar(int $id, array $usuario){
      return  $this->userRepository->actualizarUsuarios($id, $usuario);

    }



    public function eliminarUsuario(int $id)
    {

        //validaciones, si realmente es un numero y que sea mayor a 1, si es menor no enrta
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception('id de usuario no valido');
        }

        return  $this->userRepository->eliminar($id);
    }
}
