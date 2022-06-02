<?php
session_start();
$conectado = isset($_SESSION['dni']);
if (isset($_SESSION['dni'])) {
} else {
}
?>
<div>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="/WSServer/TFG/imagenes/navbar/icono.png"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul id="bar" class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="Index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="deporte" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ayuntamiento</a>
                    <div class="dropdown-menu" aria-labelledby="deporte">
                        <a class="dropdown-item" href="#">Papeles</a>
                        <a class="dropdown-item" href="telefonos.php">Telefonos</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="deporte" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Deporte</a>
                    <div class="dropdown-menu" aria-labelledby="deporte">
                        <a class="dropdown-item" href="padel.php">Padel</a>
                        <a class="dropdown-item" href="#">Gimnasio</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="agricultura.php">Agricultura</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="deporte" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Turismo</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="gastronomia.php">Gastronomia</a>
                        <a class="dropdown-item" href="#">Senderismo</a>
                </li>
            </ul>
            <?php
            if ($conectado) { ?>
                <div id='usuario'>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <?php echo ("<a class='nav-link dropdown-toggle' id='deporte' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . strtoupper($_SESSION['name']) . "</a>") ?>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="perfil.php">Perfil</a>
                                <a class="dropdown-item" href="logout.php">Salir</a>
                        </li>
                    </ul>
                </div>

            <?php } else { ?>
                <div id="log">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li id='login' class="navbar-item">
                            <a class='nav-link' href="login.php"><span class="fa-solid fa-user"> Iniciar Session</a></span>
                        </li>
                    </ul>
                </div>


            <?php } ?>
        </div>
    </nav>
</div>