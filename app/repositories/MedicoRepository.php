<?php
//REPOSITORIO medico
require_once __DIR__ . '/../../config/database.php';


class MedicoRepository{

 private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }


    public function medicos(){
        $sql= 'SELECT doctor_id, user_id, specialty_id, first_name, last_name, license_number, phone, email FROM medicos';
        $stmt= $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

