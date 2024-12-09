<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?=APP_ROOT?>css/style.css" rel="stylesheet" type="text/css" /> 
    <title> SIGIN </title>
    <script src="<?=APP_ROOT?>js/config.js"></script>
</head>
<body>

    <div class="header">
        <h1>REGISTRATE AQUÍ</h1>
    </div>
      
    <?php require APP_PATH . "html_parts/menu.php"; ?>
      
    <div class="row">

        <div class="leftcolumn">

            <div class="card">
                <h2>Registro</h2>
                <h5>Proporciona tus datos:</h5>
                <form id="register-user">
                    <table>
                        <tr>
                            <td><label for="txt-name">Nombre:</label></td>
                            <td><input type="text" name="name" id="txt-name" required />
                        </tr>
                        <tr>
                            <td><label for="txt-lastname">Apellido:</label></td>
                            <td><input type="text" name="lastname" id="txt-lastname"/>
                        </tr>
                        <tr>
                            <td><label for="tag-gender">Genero</label></td>
                            <td><select name="gender" id="tag-gender" require>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="no binario">Perfiero no especificar</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="txt-username">Username:</label></td>
                            <td><input type="text" name="username" id="txt-username" required />
                        </tr>
                        <tr>
                            <td><label for="birthday">Fecha de nacimiento:</label></td>
                            <td><input type="date" id="date-birthday" name="birthday"></td>
                        </tr>
                        <tr>
                            <td><label for="select-rol">Selecciona el rol:</label></td>
                            <td><select name="rol" id="select-rol" require>
                                <option value="1">Administrador</option>
                                <option value="0">Usuario</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="txt-password">Password:</label></td>
                            <td><input type="password" name="password" id="txt-password" required />
                        </tr>
                        <tr>
                            <td><label for="txt-confirmPassword">Confirm password:</label></td>
                            <td><input type="password" name="confirmPassword" id="txt-confirmPassword" required />
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="REGISTAR" /></td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>  <!-- End left column -->

    </div>  <!-- End row-->

    <div class="footer">
        <h2>ITI - Programación Web</h2>
    </div>
    <script src="<?=APP_ROOT?>js/register.js"></script>
</body>
</html>
