<?php
include_once('../api/db.php');
include('../api/funciones.php');

$db = new DB($db_host, $db_database, $db_user, $db_password);
$db->conectarDB();

$conectado = isset($_SESSION['dni']);

if (!isset($conectado) || $conectado == '') {
    header('Location: login.php');
}
?>

<!Doctype html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Perfil</title>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel="stylesheet" href='perfil.css'>
    <link rel="stylesheet" href='footer.css'>
    <script src="perfil.js"></script>
    <script src='../comun/msgbox.js'></script>
    <script src='../comun/api.js'></script>

</head>

<body>
    <?php include_once('navbar.php'); ?>
    <h1>PERFIL</h1>

    <div role="navigation">
        <h2>Opciones</h2>
        <cr-menu-selector role="menu">
            <iron-selector id='top-menu'>
                <a role="menu-item" id='perfil' href="perfil.php" class='cr-nav-menu-item'><span class='fa-solid fa-user' id='icperfil'> Perfil</a>
                <br>
                <a role="menu-item" id='perfil' href="reserva.php" class='cr-nav-menu-item'><span class='fa-solid fa-file-lines'> Reservas</a>
            </iron-selector>
            </cr-menu-select>
    
    <div id="info">
        <span><i class="fa-solid fa-user"></i> Usuario</span>
        <?php echo "<input type='text' id='usr' class='form-control' value='" . $_SESSION['name'] . "'>" ?>
        </br>
        <?php //echo '<input type="text"  id="dni" value="'.$_SESSION['dni'].'" hidden>' ?>
        <span><i class='fa-solid fa-id-card'></i> DNI</span>
        <?php echo "<input type='text' id='dni' class='form-control' value='" . $_SESSION['dni'] . "' disabled>" ?>
        <br>
        <span><i class="fa-solid fa-envelope"></i> Correo</span>
        <?php echo "<input type='text' id='email' class='form-control' value='" . $_SESSION['email'] . "' disabled>" ?>
        </br>
        <span><i class="fa-solid fa-envelope"></i> Nuevo Correo</span>
        <?php echo "<input type='text' id='emailn' class='form-control' value='' >" ?>
        </br>
        <span><i class="fa-solid fa-key"></i> Nueva Contraseña</span>
        <input type='password' id='password' class='form-control' value=''>
        </br>
        <button type="submit" id='guardar' class="btn btn-primary"> Guardar </button>
        <br>
    </div>
</div>
</body>
<?php include('footer.php'); ?>
<?php
?>