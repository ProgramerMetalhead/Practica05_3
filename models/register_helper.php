<?php

/**
 * Realiza la autenticación del usuario por su username y el password.
 * Regresa false en autenticación fallida y regresa un assoc array con los
 * datos del usuario cuando la autenticación es correcta.
 */

function db_insert_user($user, $passwordEncrypt, $passwordSalt,$name, $lastname, $gender, $birthday, $reg_hour, $isAdmin) {

    /**
     * validamos que el nombre de el usuario no exista. si el usuario ya existe
     * regresa un mensaje notificando que el usuario ya existe.
     */
    $sqlCmd = "SELECT username FROM usuarios WHERE username = ?";
    $db = getDbConnection();
    $stmt = $db->prepare($sqlCmd);
    $sqlParams = [$user];
    $stmt->execute($sqlParams);
    $queryResult = $stmt->fetchAll();

    if (!empty($queryResult) && $queryResult[0]["username"] == $user) {
        echo json_encode([
            "ErrMesg" => "El nombre de usuario ya está en uso"
        ]);
        exit();
    }    

    $sqlCmd =
        "INSERT INTO usuarios(username, password_encrypted, password_salt, nombre, apellidos, genero, fecha_nacimiento, 
        fecha_hora_registro, es_admin) VALUES (?,?,?,?,?,?,?,?,?);";

    $db = getDbConnection();  // obtenemos la conexión (PDO object)
    $stmt = $db->prepare($sqlCmd);  // Statement a ejecutar
    $sqlParams = [$user,$passwordEncrypt, $passwordSalt,$name, $lastname, $gender, $birthday, $reg_hour, $isAdmin];  // Parámetros de la consulta
    
    if ($stmt->execute( $sqlParams) == True){
        echo json_encode([
            "success" => "El usuario se ha registrado"
        ]);
    }else {
        echo json_encode([
            "ErrMesg" => "La consulta ha fallado!"
        ]);
    }
    exit();
}