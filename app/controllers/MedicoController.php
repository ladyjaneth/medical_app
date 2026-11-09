<?php

require_once __DIR__ . '/../services/MedicoService.php';
require_once __DIR__ . '/BaseController.php';

class MedicoController extends BaseController {

  




   public function showMedico()
   {

      $this->render('medico/medico');
   }
}
