<?php
include_once('../api/db.php');
include('../api/funciones.php');

$db = new DB($db_host, $db_database, $db_user, $db_password);
$db->conectarDB();

$conectado = isset($_SESSION['dni']);
?>

<!Doctype html>

<head>
    <meta charset="UTF-8">
    <title>Ayuntamiento</title>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="../comun/tablas.css">
    <link rel='stylesheet' href="navbar.css">
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='ayuntamiento.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>

    <script src='../comun/tablas.js'></script>
    <script src='../comun/msgbox.js'></script>
    <script src='../comun/api.js'></script>
    <script src='ayuntamiento.js'></script>
</head>

<body>
    <div id="content">
        <div id='pantalla'>
            <?php include('navbar.php'); ?>
            
            <div id="trabajadores">
                <h1>TRABAJADORES</h1>
                <div id='tabla' class='mt-2'>
                <tabla id='lista' class='table table-sm table-bordered'></tabla>
            </div>
            </div>

            <h1>TELEFONOS AYUNTAMIENTO</h1>
            <div id='tabla' class='mt-2'>
                <tabla id='lista2' class='table table-sm table-bordered'></tabla>
            </div>
        </div>
    </div>
</body>
<?php include('../comun/dbaseload.php') ?>
<?php include('footer.php'); ?>

</html>