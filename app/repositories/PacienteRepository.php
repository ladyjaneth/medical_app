<?php

require_once __DIR__ . '/../../config/database.php';

class PacienteRepository{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }


    public function mostrarPaciente(){
        $sql = 'SELECT patient_id, first_name, last_name, date_of_birth, gender, phone, email, document_number, address, insurance_number FROM pacientes';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





}
