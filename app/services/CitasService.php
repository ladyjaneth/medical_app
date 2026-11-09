<?php
//SERVICIO citas

require_once __DIR__ .'/../repositories/CitasRepository.php';


class CitasService {

    private CitasRepository $citasRepository;

    public function __construct()
    {
        $this->citasRepository = new CitasRepository();
    }
    
    public function obtenerCitas():array{
       return $this->citasRepository->Citas();
    }


    
    
}