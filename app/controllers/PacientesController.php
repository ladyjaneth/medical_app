<?php

require_once __DIR__ .'/../services/PacienteService.php';
require_once __DIR__ . '/BaseController.php';

class PacientesController extends Basecontroller {


    public function crearPaciente(){
        $this->render('paciente/crearPacientes');
    
    }


}


