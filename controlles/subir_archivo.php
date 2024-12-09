<?php
session_start();
include_once '../config.php';
require APP_PATH .'data_access/db.php'; // Conexión a la base de datos

// Validar usuario autenticado
if (!isset($_SESSION['Usuario_Id'])) {
    echo json_encode(['mensaje' => 'Usuario no autenticado']);
    exit();
}

// Verificar si hay un archivo enviado
if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $usuarioId = $_SESSION['Usuario_Id'];
    $descripcion = $_POST['descripcion'] ?? '';
    $archivo = $_FILES['archivo'];

    // Validar tipo de archivo
    $tiposPermitidos = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($archivo['type'], $tiposPermitidos)) {
        echo json_encode(['mensaje' => 'Tipo de archivo no permitido']);
        exit();
    }

    // Generar un nombre único para el archivo
    $nombreOriginal = basename($archivo['name']);
    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nombreUnico = hash('sha256', uniqid() . $nombreOriginal) . '.' . $extension;

    // Ruta de guardado
    $rutaDestino = DIR_UPLOAD . $nombreUnico;

    // Mover el archivo
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        $tamaño = $archivo['size'];
        $hashArchivo = hash_file('sha256', $rutaDestino);

        // Guardar registro en la base de datos
        $db = getDbConnection(); // Asume que tienes esta función
        $stmt = $db->prepare("INSERT INTO archivos (descripcion, nombre_archivo, extension, nombre_archivo_guardado, tamaño, hash_sha256, fecha_subido, usuario_subio_id) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
        $stmt->execute([$descripcion, $nombreOriginal, $extension, $nombreUnico, $tamaño, $hashArchivo, $usuarioId]);

        $archivoId = $db->lastInsertId();

        // Registrar en el log
        $stmtLog = $db->prepare("INSERT INTO archivos_log_general (archivo_id, usuario_id, fecha_hora, accion_realizada, ip_realiza_operacion) VALUES (?, ?, NOW(), ?, ?)");
        $stmtLog->execute([$archivoId, $usuarioId, 'Archivo subido', $_SERVER['REMOTE_ADDR']]);

        echo json_encode(['mensaje' => 'Archivo subido con éxito']);
    } else {
        echo json_encode(['mensaje' => 'Error al mover el archivo']);
    }
} else {
    echo json_encode(['mensaje' => 'Error al subir el archivo']);
}
?>
