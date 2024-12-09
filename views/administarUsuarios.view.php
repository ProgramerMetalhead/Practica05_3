
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?=APP_ROOT?>css/style.css" rel="stylesheet" type="text/css" /> 
    <script src="<?=APP_ROOT?>js/config.js"></script>
    <title>Administrar Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: whitesmoke;
            color: black;
            padding: 1rem;
            text-align: center;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 1rem;
        }
        .leftcolumn {
            flex: 100%;
            padding: 1rem;
        }
        .card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            margin-bottom: 1rem;
        }
        table.table-grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table.table-grid th, table.table-grid td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: center;
        }
        table.table-grid th {
            background-color: gray;
            color: white;
        }
        #adminModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #adminModal div {
            background: #fff;
            padding: 2rem;
            border-radius: 5px;
            width: 400px;
            max-width: 90%;
        }
        #adminModal h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        #adminModal label {
            display: block;
            margin: 0.5rem 0;
        }
        #adminModal input, #adminModal select, #adminModal button {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
        }
        #adminModal button {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
        #adminModal button:hover {
            background-color: black;
        }
      
    </style>
</head>
<body>
    <div class="header">
        <h1>Gestión de Usuarios</h1>
    </div>

    <?php require APP_PATH . "html_parts/menu.php"; ?>

    <div class="row">
        <div class="leftcolumn">
            <div class="card">
                <h2>Sistema de Usuario</h2>
                <p>Administra y controla los usuarios registrados:</p>
                <form id="register-user">
                    <table class="table-grid">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Genero</th>
                                <th>Fecha de nacimiento</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Administrar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas dinámicas -->
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="adminModal">
        <div>
            <h2>Administrar Usuario</h2>
            <form id="adminForm">
                <input id="modalUserId"/>
                <div>
                    <label for="modalPassword">Nuevo Password:</label>
                    <input type="password" id="modalPassword" placeholder="Ingrese nuevo password" />
                </div>
                <div>
                    <label for="modalRole">Nuevo Rol:</label>
                    <select id="modalRole">
                        <option value="0">Usuario</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit">Guardar Cambios</button>
            </form>
            <button id="closeModal">Cerrar</button>
        </div>
    </div>

    <script src="<?=APP_ROOT?>js/adminstarUsuarios.js"></script>
</body>
</html>
