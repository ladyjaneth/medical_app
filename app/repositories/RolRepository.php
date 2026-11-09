<?php
//REPOSITORIO
require_once __DIR__ . '/../../config/database.php';

class RolRepository
{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function mostrarRoles()
    {

        $sql = 'SELECT role_id, name, description FROM roles';

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //el execute da un valor booleano
    public function actualizarRoles(int $id, array $role): bool
    {
        $stmt = $this->pdo->prepare('UPDATE roles SET name = :name, description = :description WHERE role_id = :role_id');
        $stmt->bindParam(':name', $role['name'], PDO::PARAM_STR, 50);
        $stmt->bindParam(':description', $role['description'], PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }




    // que busque por id para editar 
    public function buscarId(int $id)
    {
        //$stmt = $this->pdo->prepare('SELECT * FROM roles WHERE role_id = :role_id');

        $stmt = $this->pdo->prepare('SELECT role_id, name, description FROM roles WHERE role_id = :role_id');
        $stmt->bindParam(':role_id', $id, PDO::PARAM_INT);  // le pasa los parametros que le pasaron 
        $stmt->execute();

        // Retorna un array asociativo con los datos, o 'false' si no encuentra nada
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }





    public function buscarporNombre(string $nombre)
    {
        $sql = 'SELECT * FROM roles WHERE LOWER(name) = LOWER(:name) LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => trim($nombre)]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * Inserta un nuevo rol en la base de datos.
     * Retorna el ID generado o false si ocurre un error.
     */
    public function guardarRol(array $role): int|false
    {
        $sql = 'INSERT INTO roles (name, description) VALUES (:name, :description)';

        $stmt = $this->pdo->prepare($sql);



        $exito = $stmt->execute([
            ':name'        => $role['name'],
            ':description' => $role['description'] ?? null
        ]);

        if ($exito) {
            return (int) $this->pdo->lastInsertId();
        }

        return false;
    }



    public function eliminaRol(int $id)
    {
        $sql = 'DELETE FROM roles WHERE role_id = :role_id';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':role_id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }

        return false;
    }
}
