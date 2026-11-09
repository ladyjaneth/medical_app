<?php

require_once __DIR__ . '/../repositories/PacienteRepository.php';

class PacienteService
{

    private PacienteRepository $pacienteRepository;

    public function __construct()
    {
        $this->pacienteRepository = new PacienteRepository;
    }


    public function pacientes(){
     return   $this->pacienteRepository->mostrarPaciente();
    }


}
