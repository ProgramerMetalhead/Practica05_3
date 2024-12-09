<?php

require '../config.php';
require APP_PATH .'data _access/db.php';
require APP_PATH ."models/generate_password.php";

$user_id = (int) filter_input(INPUT_POST, "id");
$password = filter_input(INPUT_POST, "password");
$rol = (int) filter_input(INPUT_POST,"rol");

if (!isset($user_id, $password, $rol) || $user_id == "" || $password == "" || $rol == "") {
    echo json_encode([
        "Error" => true,
        "ErrMesg" => "data params not validate"
    ]);
    exit();
}

$passwordSumary = encrypt_password($password);

if (!$passwordSumary){
    echo json_encode([
        "Error" => true,
        "ErrMesg" => "error was happen in password encryptation"
    ]);
    exit();    
}

$password_encrypt = $passwordSumary['passwordEncrypted'];
$password_salt = $passwordSumary['passwordSalt'];

db_update_userdata($user_id,$password_encrypt,$password_salt,$rol);

function db_update_userdata($user_id, $password_encrypt, $password_salt, $rol){

    $db_conection = getDbConnection();
    $sql = "UPDATE usuarios SET password_encrypted = ?, password_salt = ?, es_admin = ? WHERE id = ?;";
    $stmt = $db_conection->prepare($sql);
    $slqParams = [$password_encrypt,$password_salt,$rol,$user_id];
    $stmt->execute($slqParams);

    echo json_encode([
        'success' => true
    ]);
    
    exit();
    
}
