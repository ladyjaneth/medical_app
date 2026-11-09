<?php
//CONSTROLADOR citas
require_once __DIR__ .
   '/../services/CitasService.php';
require_once __DIR__ .
   '/BaseController.php';

class CitasController extends BaseController
{
   private CitasService $citasService;
   private MedicoService $medicoService;
   private PacienteService $pacienteService;
   private UsuarioService $usuarioService;



   public function __construct()
   {
      $this->citasService = new CitasService();
      $this->medicoService = new MedicoService();
      $this->pacienteService = new PacienteService();
      $this->usuarioService = new UsuarioService(); //
   }



   public function create(): void
   {
      $pacientes = $this->pacienteService->pacientes();
      $medicos = $this->medicoService->obtenerMedicos();
      $this->render('citas/crearCitas', ['medicos' => $medicos, 'pacientes'=>$pacientes]);
   }


   public function mostrarCitas()
   {
      $citas = $this->citasService->obtenerCitas();
      $this->render('citas/mostrarCitas', ['citas' => $citas]);
   }
}
