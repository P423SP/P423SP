<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='login.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src='../comun/msgbox.js'></script>
    <script src='../comun/api.js'></script>
    <script src='login.js'></script>

</head>

<body>
    <script>
        var expired = <?php echo $_GET['expired'] ?? 'false'; ?>;
    </script>

    <div id='log'>
        <h1>Iniciar Session</h1>
        <form class=''>
            <div class="form-group">
                <label><span class="fa-solid fa-id-card"></span> DNI</label>
                <input id="dni" type="text" class="form-control" placeholder="Dni">
                <label><span class="fa-solid fa-key"></span> Contraseña</label>
                <input id='paswd' type="password" class="form-control" placeholder="Contraseña">
            </div>
        </form>
        <br>
        <button type='submit' id='Enviar' class="btn btn-primary Enviar">Enviar</button>
        <button type='cancel' id="Cancelar" class='btn btn-danger'>Cancelar</button>
        <p><a href="newUser.php">Crear cuenta</a></p>
    </div>
    <?php include('../comun/dbaseload.php') ?>
</body>

</html>