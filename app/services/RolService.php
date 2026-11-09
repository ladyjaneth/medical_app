<?php
//SERVICIO
require_once __DIR__ . '/../repositories/RolRepository.php';

class RolService
{

    private RolRepository $rolRepository;

    public function __construct()
    {
        $this->rolRepository = new RolRepository();
    }


    public function obtenerRoles(): array
    {
        return $this->rolRepository->mostrarRoles();
    }

    public function buscarId(int $id)
    {
        return $this->rolRepository->buscarId($id);
    }


    public function actualizaRol(int $id, array $role)
    {
        return $this->rolRepository->actualizarRoles($id, $role);
    }


    //recibir los datos que envia el formulario 
    //validar qque los campos obligarorios esten llenos 
    //valida y procesa la creación de un nuevo rol 
    //evitar que un rol se repetido
    //manejar errores para que el controlador muestre un mensaje en la vista
    public function guardarRole(array $role)
    {
        //la validación aqui en el servicio 
        $rolExistente = $this->rolRepository->buscarporNombre($role['name']);

        if ($rolExistente) {
            //tiro una excepcion que el error lo capturo en un try catch en el controlador, Retornar un mensaje amigable o redirigir con error
            throw new Exception("El rol '{$role['name']}' ya se encuentra registrado.");
        }

        return  $this->rolRepository->guardarRol($role);
    }


    public function eliminarRole(int $id){
        //validaciones, si realmente es un numero y que sea mayor a 1, si es menor no enrta
        if(!is_numeric($id) || $id<=0){
            throw new Exception('id de rol invalido');
        }

        //Si el ID pasó la prueba, llega hasta aquí y elimina el rol
        return $this->rolRepository->eliminaRol($id);

    }




}
