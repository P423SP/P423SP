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
    <title>Contacto</title>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="footer.css">
    <link rel='stylesheet' href='contacto.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <script src='../comun/msgbox.js'></script>
</head>

<body>
    <?php include('navbar.php') ?>

    <div id="content">
        <img id="ayunt" src="../imagenes/contacto/1.jpg">
        <div id='telefonos'>
            <h1>TELEFONOS</h1>
            <p>
                <span class="fa-solid fa-phone"></span> : 962896011
                <br>
                <span class="fa-solid fa-mobile-screen"></span> : 673432368
            </p>
        </div>
        <div id='redes'>
            <h1>REDES SOCIALES</h1>

            <div id="redes">

                <a class="btn btn-icon btn-facebook" href="https://www.facebook.com/people/Ajuntament-Llocnou-St-Jeroni/100068633234950/?__xts__[0]=68.ARDaermINavr-Js2Hrsj5XS0sP2Ke3wKsyLWv-fsuN5DQMWZScOFexHbaAVnYdgTG-ZXH-FRcsxi14NMEBM3wx2b_zpUvSDkTQTTS1gVc9tdbA5BVd9TXBFbFD9-CTtBDfYElvnAAzNhqdZFZsRBvwvnN3L4oXcUCqElf_YxwF"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                <a class="btn btn-icon btn-twitter" href="https://twitter.com/llocnou"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                <a class="btn btn-icon btn-gmail" href="https://www.addtoany.com/add_to/email?linkurl=http%3A%2F%2Fwww.llocnoudesantjeroni.es%2Fpagina%2Fservei-dinformacio-municipal&linkname=Servei%20d%27Informaci%C3%B3%20municipal&linknote="><i class="fa fa-google-plus"></i><span>Gmail</span></a>
                <br>
                <a class="btn btn-icon btn-telegram" href="https://telegram.me/share/url?url=http%3A%2F%2Fwww.llocnoudesantjeroni.es%2Fpagina%2Fcorporacio-actual&text=Corporaci%C3%B3%20actual"><i class="fa fa-telegram"></i><span>Telegram</span></a>
                <a class="btn btn-icon btn-whatsapp" href="https://api.whatsapp.com/send?text=Corporaci%C3%B3%20actual%20http%3A%2F%2Fwww.llocnoudesantjeroni.es%2Fpagina%2Fcorporacio-actual"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a>
            </div>

        </div>
    </div>
</body>
<?php include('footer.php') ?>

</html>