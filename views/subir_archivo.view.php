<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />    <title>Subir Archivos</title>
    <link href="<?=APP_ROOT?>css/style.css" rel="stylesheet" type="text/css" /> 
    <script src="<?=APP_ROOT?>js/config.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require APP_PATH . "html_parts/menu.php"?>
    <h1>Subir Archivos</h1>
    <form id="formSubirArchivos" enctype="multipart/form-data">
        <label for="descripcion">Descripción (opcional):</label><br/>
        <textarea id="descripcion" name="descripcion" rows="3"></textarea><br/>
        <label for="archivo">Seleccionar archivo:</label>
        <input type="file" id="archivo" name="archivo" accept=".pdf, .jpg, .jpeg, .png, .gif" required><br>
        <button type="submit">Subir Archivo</button>
    </form>

    <div id="mensaje"></div>

    <script>
        $(document).ready(function() {
            $('#formSubirArchivos').on('submit',async function(e) {
                e.preventDefault();

                // Crear un FormData para enviar datos con AJAX
                var formData = new FormData(this);

                const response = await fetch(`${APP_ROOT}controllers/subir_archivo.php`,{
                    method: "POST",
                    body: formData
                });

                const jsonResponse = await response.json();
                
                alert(jsonResponse.mensaje);
                
            });
        });
    </script>
</body>
</html>
