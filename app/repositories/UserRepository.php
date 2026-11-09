<?php

require_once __DIR__ . '/../../config/database.php';

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findByEmail(string $email)
    {
        $sql = "
            SELECT
              u.user_id,
              u.role_id,
              u.username,
              u.email, 
              u.password_hash,
              u.status,

              r.name AS role
              
              FROM usuarios AS u
              INNER JOIN roles AS r
              ON r.role_id = u.role_id
              WHERE u.email = :email
              LIMIT 1                                   
            
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }


    //para mostrar el nombre del rol en la tabla donde muestro todos los usuarios hago un join de las tablas roles y usuarios
    public function mostrarusuario(){
        $sql = 'SELECT u.user_id, u.role_id, r.name AS nombre_rol, u.username, u.email, u.password_hash, u.status, u.created_at 
        FROM usuarios u   
        LEFT JOIN roles r ON u.role_id = r.role_id';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarId(int $id){
        $stmt = $this->db->prepare('SELECT user_id, role_id, username, email, password_hash, status FROM usuarios WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function actualizarUsuarios(int $id, array $usuario){
            $sql= 'UPDATE usuarios SET role_id = :role_id,
            username = :username,
            email = :email,
            status = :status,
            WHERE user_id = :user_id'; 

            $stmt = $this->db->prepare($sql);

            $exito = $stmt->execute([
            ':role_id' =>$usuario['role_id'],   
            ':username'=> $usuario['username'],
            ':email'=> $usuario['email'],
            ':status'=>$usuario['status'],
            ':user_id'=>$usuario['user_id']
            ]);


              if($exito){
            return (int) $this->db->lastInsertId();
        }
        return false;




       /*  $stmt = $this->db->prepare('UPDATE usuarios SET username = :username, email = :email,  ');
        $stmt->bindParam(':username', $usuario['username'], PDO::PARAM_STR, 50);
        $stmt->bindParam(':email', $usuario['email'], PDO::PARAM_STR, 100);
       

        return $stmt->execute(); */
    }






    //metodo para guardar el usuario en la base de datos 
    public function save(array $user)
    {
        $sql = 'INSERT INTO usuarios (role_id, username, email, password_hash) 
        VALUES (:role_id, :username, :email, :password_hash)';


        $stmt = $this->db->prepare($sql);

        $exito = $stmt->execute([
            ':role_id' => $user['role_id'],
            ':username' => $user['username'],
            ':email' => $user['email'],
            ':password_hash' => $user['password_hash'],
            
        ]);


        if($exito){
            return (int) $this->db->lastInsertId();
        }
        return false;
    }



    public function eliminar(int $id){
        $sql= 'DELETE FROM usuarios WHERE user_id = :user_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return $stmt->rowCount() >0;
         }
         return false;
    }




    
}
