<?php

require 'config.php';
require APP_PATH . 'data _access/db.php';
require APP_PATH . 'services/administarUsuarios_helper.php';

// Ejecuta la consulta hacia la base de datos
db_get_users();
