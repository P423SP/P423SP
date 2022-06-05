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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="../comun/tablas.css">
    <link rel="stylesheet" href='perfil.css'>
    <link rel="stylesheet" href='footer.css'>

    <script src='../comun/msgbox.js'></script>
    <script src='../comun/tablas.js'></script>
    <script src='../comun/api.js'></script>
    <script src="reserva.js"></script>

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
    </div>

    <?php if(isset($conectado)){ echo '<input type="text"  id="dni" value="' . $_SESSION['dni'] . '" hidden>';} ?>

    <div id='tabla' class='mt-2'>
        <tabla id='lista' class='table table-sm table-bordered'></tabla>
    </div>
    </div>
    <?php include('../comun/dbaseload.php') ?>
</body>
<?php include('footer.php'); ?>

</html>