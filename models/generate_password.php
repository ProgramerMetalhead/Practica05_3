<?php

// Cryptic writtings rolon
function encrypt_password($password){

    $tamañoBytes = 32;
    $bytesRandom = random_bytes($tamañoBytes);
    $salt = strtoupper(bin2hex($bytesRandom));

    $passwordMasSalt = $password . $salt;
    $passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));

    return [
        'passwordEncrypted' => $passwordEncrypted,
        'passwordSalt' => $salt
    ];
    
}