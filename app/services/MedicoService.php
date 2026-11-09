<?php
//SERVICIO medico

require_once __DIR__ . '/../repositories/MedicoRepository.php';

class MedicoService
{

    private MedicoRepository $medicoRepository;

    public function __construct()
    {
        $this->medicoRepository = new MedicoRepository;
    }


    public function obtenerMedicos(): array{
       return $this->medicoRepository->medicos();
    }













}










