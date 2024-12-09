<?php

require APP_PATH ."data _access/db.php";

function validar_admin($user_id){
    
    if (!$user_id){
        return false;
    }

    $db_conection = getDbConnection();
    $sql = "SELECT es_admin FROM usuarios WHERE id = ?";
    $stmt = $db_conection->prepare($sql);
    $slqParams = [$user_id];
    $stmt->execute($slqParams);
    $result = $stmt->fetchAll();

    if (!$result[0]){
        return false;
    }
    else if ($result[0]["es_admin"] == 1){
        return true;
    }

}