<?php 
    require_once APP_PATH . "services/session.php";
    require APP_PATH . "controlles/validar_admin.php"; 
?>

<div class="topnav">
    <?php if ($USUARIO_AUTENTICADO): ?>
        <a href="<?=APP_ROOT?>">Home</a>
        <a href="<?=APP_ROOT?>subir_archivo.php">Subir un<br /> archivo</a>
        <a href="<?=APP_ROOT?>administrarArchivos.php">Administar <br />Archivos</a>
        <?php if (validar_admin($_SESSION['Usuario_Id'])): ?>
            <a href="<?=APP_ROOT?>administrarUsuarios.php">Administar<br /> Usuarios</a>
        <?php endif; ?>  
        <a href="#" style="float:right">Link</a>
    <?php else: ?>
        <a href="<?=APP_ROOT . "login.php"?>">Login</a>
    <?php endif; ?>
</div>
