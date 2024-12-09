<?php
    
require_once '../config.php';
require APP_PATH .'data_access/db.php';

$id = $_GET['id']; 

if (!isset($id)) {
    echo json_encode([
        'Error' => true,
        'ErrMesg' => 'id not found in POST headers'
    ]);
    exit();
}

eliminar_usuario($id);

function eliminar_usuario($user_id){
    
    if (!$user_id){
        return false;
    }

    $db_conection = getDbConnection();
    $sql = "DELETE FROM `usuarios` WHERE id = ?;";
    $stmt = $db_conection->prepare($sql);
    $slqParams = [$user_id];
    $stmt->execute($slqParams);

    echo json_encode([
        'success' => true
    ]);
    
    exit();

}
