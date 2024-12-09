<?php

require_once '../config.php';
require APP_PATH .'data_access/db.php';
require APP_PATH . 'services/session.php';

try {
    $db_conection = getDbConnection();

    // Obtener archivos con filtros de usuario, año y mes
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($USUARIO_ID)) {
        $user_id = $USUARIO_ID;
        $year = isset($_GET['year']) ? filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT) : null;
        $month = isset($_GET['month']) ? filter_input(INPUT_GET, 'month', FILTER_SANITIZE_STRING) : null;

        $sql = "SELECT DISTINCT
                    A.id, 
                    A.descripcion, 
                    A.extension, 
                    A.nombre_archivo, 
                    A.nombre_archivo_guardado, 
                    A.tamaño,
                    A.fecha_subido, 
                    A.cant_descargas, 
                    A.es_publico,
                    A.favorito
                FROM 
                    archivos A
                WHERE 
                    A.usuario_subio_id = ?";
        
        // Aplicar filtros de año y mes si están presentes
        if ($year) {
            $sql .= " AND YEAR(A.fecha_subido) = ?";
        }
        if ($month) {
            $sql .= " AND MONTH(A.fecha_subido) = ?";
        }

        $stmt = $db_conection->prepare($sql);
        $sqlParams = [$user_id];

        if ($year) {
            $sqlParams[] = $year;
        }
        if ($month) {
            $sqlParams[] = $month;
        }

        $stmt->execute($sqlParams);
        $result = $stmt->fetchAll();

        if (!$result) {
            echo json_encode(["ErrMesg" => "No se encontraron archivos para el usuario o filtros dados."]);
            exit();
        }

        $user_archives = [];
        foreach ($result as $archive) {
            $user_archives[] = [
                "id" => $archive["id"],
                "nombre_archivo" => $archive["nombre_archivo"],
                "descripcion" => $archive["descripcion"],
                "extension" => $archive["extension"],
                "tamaño" => $archive["tamaño"],
                "fecha_subido" => $archive["fecha_subido"],
                "es_publico" => $archive["es_publico"],
                "favorito" => $archive["favorito"]
            ];
        }

        echo json_encode($user_archives);
        exit();
    }

    // Eliminar archivo
    if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET["id"])) {
        $archive_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $sql = "DELETE FROM archivos WHERE id = ?";
        $stmt = $db_conection->prepare($sql);
        $stmt->execute([$archive_id]);

        echo json_encode(["success" => true]);
        exit();
    }

    // Actualizar archivo (descripción, tipo, favorito)
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $rawData = file_get_contents("php://input");
        $fromData = json_decode($rawData, true);

        if ($fromData === null) {
            echo json_encode(['error' => 'Error al decodificar JSON.']);
            exit;
        }

        if (isset($fromData['id'])) {
            $id = filter_var($fromData['id'], FILTER_VALIDATE_INT);

            // Validación del ID
            if ($id === false) {
                echo json_encode(['error' => 'El ID no es válido.']);
                exit;
            }

            // Actualización dinámica según los datos enviados
            $fields = [];
            $values = [];

            if (isset($fromData['descripcion'])) {
                $fields[] = "descripcion = ?";
                $values[] = filter_var($fromData['descripcion'], FILTER_SANITIZE_STRING);
            }

            if (isset($fromData['tipo'])) {
                $fields[] = "es_publico = ?";
                $values[] = filter_var($fromData['tipo'], FILTER_VALIDATE_INT);
            }

            if (isset($fromData['favorito'])) {
                $fields[] = "favorito = ?";
                $values[] = filter_var($fromData['favorito'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }

            if (empty($fields)) {
                echo json_encode(['error' => 'No se enviaron campos para actualizar.']);
                exit;
            }

            $values[] = $id;
            $sql = "UPDATE archivos SET " . implode(", ", $fields) . " WHERE id = ?";
            $stmt = $db_conection->prepare($sql);
            $stmt->execute($values);

            echo json_encode(["success" => true]);
            exit();
        } else {
            echo json_encode(['error' => 'El ID es requerido para la actualización.']);
            exit();
        }
    }
} catch (Exception $error) {
    echo json_encode(["Error" => $error->getMessage()]);
    exit();
}
