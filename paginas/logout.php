<?php
    include_once("../api/db.php");
    include("../api/funciones.php");
    
    session_start();
    session_destroy();
    toLoginIfNotConnected();
    $db=new DB($db_host, $db_database, $db_user, $db_password);
    $db->conectarDB();
    toLogin();
?>