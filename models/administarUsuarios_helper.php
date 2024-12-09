<?php 

function db_get_users(){
    
    $sqlCmd = "SELECT * FROM usuarios";
    $db_conection = getDbConnection();
    $stmt = $db_conection->prepare($sqlCmd);
    $stmt->execute();
    $queryResult = $stmt->fetchAll();
    
    if(!$queryResult){
        return [
            'ErrMess' => 'not found data in sql query'
        ];
    }

    $json_response = [];

    foreach($queryResult as $user){

        $json_response[] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'name' => $user['nombre'],
            'lastname' => $user['apellidos'],
            'gender' => $user['genero'],
            'birthday' => $user['fecha_nacimiento'],
            'reg_day' => $user['fecha_hora_registro'],
            'is_admin' => $user['es_admin'],
            'is_active' => $user['activo']
        ];
    }    

    echo json_encode($json_response);
    exit();

}