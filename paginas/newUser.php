<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Crear Cuenta</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='newUser.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' type='text/css' media='screen' href='gastronomia.css'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <script src='../comun/msgbox.js'></script>
    <script src='../comun/api.js'></script>
    <script src='newUser.js'>
    </script>
</head>

<body>
    <div id='new'>
        <div id='form'>
            <h1>Crear Cuenta</h1>
            <form id='newAcc'>
                <span><i class="fa-solid fa-user"></i> Usuario</span>
                <input type="text" id='usr' class="form-control" placeholder="Usuario">
                <span><i class="fa-solid fa-id-card"></i> DNI</span>
                <input type='text' id='dni' class='form-control' placeholder='11111111Q'>
                <span><i class="fa-solid fa-envelope"></i> Correo</span>
                <input type='text' id='email' class='form-control' placeholder='ejemplo@gmail.com'>
                <span><i class="fa-solid fa-key"></i> Contraseña</span>
                <input type='password' id='pass1' class='form-control' placeholder="Contraseña">
                <span><i class="fa-solid fa-key"></i> Repetir contraseña</span>
                <input type='password' id='pass2' class='form-control' placeholder='Repetir contraseña'>
            </form>
        </div>
        <br>
        <button type='submit' id='Enviar' class='btn btn-primary'>Registrar</button>
        <button type='cancel' id='Cancelar' class='btn btn-danger'>Cancelar</button>
    </div>
    <!-- <?php include('../comun/dbaseload.php') ?> -->
</body>

</html>