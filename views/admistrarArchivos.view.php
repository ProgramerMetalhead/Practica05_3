<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=APP_ROOT?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=APP_ROOT?>css/administarArchivos.css" rel="stylesheet" type="text/css" />
    <script src="<?=APP_ROOT?>js/config.js"></script>
    <title>Administrar Documentos</title>
</head>
<body>
    <div class="header">
        <h1>Gestión de Archivos</h1>
    </div>

    <!-- Filtros de Año y Mes -->
    <div class="filters">
        <label for="year-filter">Año:</label>
        <select id="year-filter">
            <option value="">Todos</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
        <label for="month-filter">Mes:</label>
        <select id="month-filter">
            <option value="">Todos</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option value="03">Marzo</option>
        </select>
    </div>

    <?php require APP_PATH . "html_parts/menu.php"; ?>

    <div class="row">
        <div class="leftcolumn">
            <div class="card">
                <h2>Lista de Archivos</h2>
                <p>Administra y controla los archivos registrados:</p>
                <form id="manage-files">
                    <table class="table-grid">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Extensión</th>
                                <th>Tamaño</th>
                                <th>Fecha Subido</th>
                                <th>Visibilidad</th>
                                <th>Favorito</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas dinámicas renderizadas con JS -->
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="archivoModal">
        <div>
            <h2>Administrar Archivo</h2>
            <form id="archivoForm">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" placeholder="Ingrese una descripción"></textarea>
                <label for="tipo">Tipo</label>
                <select id="tipo">
                    <option value="1">Público</option>
                    <option value="0">Privado</option>
                </select>
                <button type="submit">Guardar Cambios</button>
            </form>
            <button id="closeModal">Cerrar</button>
        </div>
    </div>

    <script src="<?=APP_ROOT?>js/administrarArchivos.js"></script>
</body>
</html>
