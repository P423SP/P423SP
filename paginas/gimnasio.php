<?php
include_once('../api/db.php');
include('../api/funciones.php');

$db = new DB($db_host, $db_database, $db_user, $db_password);
$db->conectarDB();

$conectado = isset($_SESSION['dni']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gimnasio</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="../comun/tablas.css">
    <link rel='stylesheet' href="../comun/msgbox.css">

    <script src='../comun/tablas.js'></script>
    <script src='../comun/msgbox.js'></script>
    <script src='../comun/api.js'></script>
    <script src='gimnasio.js'></script>

    <link rel='stylesheet' type='text/css' media='screen' href='gimnasio.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
</head>

<body>
    <?php include('navbar.php') ?>

    <div id="contenido">
        <img id="gym" src="../imagenes/gimnasio/1.jpg">

        <h1>GIMNASIO</h1>
        <p>
            El gimnasio esta situado en el edificio polivalente del pueblo junto al ayuntamiento.
            Cuenta con una gran variedad de máquinas para todo tipo de entrenamiento, además también contamos con monitores que estarán disponibles en todo momento para ayudarte en lo que necesites.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, repellat sunt obcaecati cupiditate inventore aspernatur! Accusamus rerum ipsum ad neque et cumque, quia maxime, quis necessitatibus, quibusdam eos asperiores ut.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deleniti perferendis saepe quis debitis? Voluptatem, mollitia tempora perspiciatis nisi dignissimos, consequuntur exercitationem commodi, quasi labore veniam autem ducimus amet quos id?
        </p>

        <h1>MÁQUINAS</h1>
        <div id='tabla' class='mt-2'>
            <tabla id='lista' class='table table-sm table-bordered'></tabla>
        </div>

        <?php if ($conectado) { ?>
            <?php echo '<input type="text"  id="dni" value="' . $_SESSION['dni'] . '" hidden>' ?>
            <br>
            <div id="more">
                <button id="añadir" class="btn btn-primary">Añadir</button>
            </div>
        <?php } ?>
    </div>

</body>
<?php include('footer.php') ?>

</html>