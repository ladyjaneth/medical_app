<?php
//REPOSITORIO citas
require_once __DIR__ . '/../../config/database.php';

class CitasRepository
{
    private PDO $pdo;


    public function __construct()
    {
        $this->pdo = Database::connect();
    }


    public function Citas()
    {

        $sql = 'SELECT appointment_id, patient_id, doctor_id, scheduled_at, status, reason, created_at, created_by_user_id, updated_at FROM citas';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
