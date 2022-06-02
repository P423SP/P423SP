<?php 
    include_once('../api/db.php');
    include('../api/funciones.php');

    $db = new DB($db_host, $db_database, $db_user, $db_password);
    $db->conectarDB();

    $conectado=isset($_SESSION['dni']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Inicio</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="footer.css">
    
    <script src='../comun/msgbox.js'></script>
    <script src='index.js'></script>
</head>

<body>
    <?php include('navbar.php') ?>
    <div id="imgs">
        <img id="imag" class="foto" src="../imagenes/Index/imgs/1.PNG">
        <img id="imag" class="foto" src="../imagenes/Index/imgs/2.PNG">
        <img id="imag" class="foto" src="../imagenes/Index/imgs/3.PNG">
    </div>

    <div id="redes">
        <div class="boton-facebook boton">
            <a target='_blank' alt='facebook' href='https://www.facebook.com/Ajuntament-Llocnou-St-Jeroni-116504702393417/?__xts__[0]=68.ARDaermINavr-Js2Hrsj5XS0sP2Ke3wKsyLWv-fsuN5DQMWZScOFexHbaAVnYdgTG-ZXH-FRcsxi14NMEBM3wx2b_zpUvSDkTQTTS1gVc9tdbA5BVd9TXBFbFD9-CTtBDfYElvnAAzNhqdZFZsRBvwvnN3L4oXcUCqElf_YxwF'>
                <div class='text'><img id='facebook' src="../imagenes/Index/logo/face.png"></img></div>
            </a>

        </div>
    </div>

    <div id="content">
        <div id="novedades">
            <h1>NOVEDADES</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis nobis voluptatibus atque illum fugiat
                adipisci excepturi corporis, necessitatibus aspernatur amet at quisquam sint id explicabo laborum ad
                voluptatem expedita perspiciatis.</p>
        </div>
        <div id='historia'>
            <h1>HISTÓRIA</h1>
            <div id="logo"> <img id="escudo" src="../imagenes/Index/logo/escudo.png"></img></div>
            <p>Los restos de la Antigüedad que se conocen corresponden a la época romana. Se trata de tres fragmentos de lápidas con inscripciones latinas. Uno de ellos apareció
                en la partida de la Granja, donde se supone que hubo una villa rústica durante los primeros siglos de nuestra Era.
                Este pueblo tuvo como antecesor el mudéjar "Rafalet de Bonamira", que perteneció, tras la conquista, al mismo Jaime I Conquistador, quien lo concedió a su hijo el infante
                Pedro (Pedro el Grande), pasando luego a otras manos, como a Ximén Pérez de Arenós, quien lo vendió a Arnau Saurina, del que pasó al duque de Gandía, el cual lo
                donó a los monjes de San Jerónimo de Cotalba en 1420. El 8 de diciembre de 1609, este monasterio fundó Lugar Nuevo de San Jerónimo en el término del antiguo Rafalet. </p>

        </div>
        <div id="llegar">
            <br>
            <h1>COMO LLEGAR</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3104.482764618177!2d-0.287219149350619!3d38.91294185353322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd61eb5c98795353%3A0x2f296053920daabf!2s46726%20Lugar%20Nuevo%20de%20San%20Jer%C3%B3nimo%2C%20Valencia!5e0!3m2!1ses!2ses!4v1649610882417!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>

</html>