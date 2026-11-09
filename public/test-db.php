
<?php

require_once '../config/database.php';

try{
    $db= Database::connect();
    echo "conexión exitosa";

}catch(Exception $excepcion){
    echo $excepcion->getMessage();
}
