<?php
include("funciones.php");
include_once("db.php");
include_once("apiFunction.php");


function doLogin($dni, $password)
{
    global $db;

    $tituloFuncion = 'Login';
    try {
        $reg = $db->getSQLRegister("SELECT  name, dni, password, email FROM usuarios  where dni=? ", array($dni));

        if ($reg) {
            $passwordHash = $reg['password'];
            if ($reg['dni'] == $dni && password_verify($password, $passwordHash)) {
                $data = array('estado' => 'success');
                session_start();
                $_SESSION['name'] = $reg['name'];
                $_SESSION['dni'] = $reg['dni'];
                // $_SESSION['dniO'] = $reg['dniO'];
                $_SESSION['password'] = $reg['password'];
                $_SESSION['email'] = $reg['email'];
            } else {
                $data = array('estado' => 'error', 'errorTitulo' => 'Login', 'errorMensaje' => "Usuario '$dni' incorrecto");
            }
        } else {
            $data = array('estado' => 'error', 'errorTitulo' => 'Login', 'errorMensaje' => "Usuario '$dni' incorrecto");
        }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    }
    return $data;
}


function llistarTelefono()
{
    global $db;
    $tituloFuncion = 'listar telefonos';
    $r = false;

    try {
        $sql = "SELECT nombre as Nombre, telefono as Telefono FROM telefonos";
        $r = $db->doQuery($sql);
        $data = $db->query2Data($r, $tituloFuncion, 'No hay telefonos disponibles para listar.');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}

function listarTrabajadores()
{
    global $db;
    $tituloFuncion = 'listar trabajadores';
    $r = false;

    try {
        $sql = "SELECT nombre as Nombre , trabajo as Puesto FROM trabajadores";
        $r = $db->doQuery($sql);
        $data = $db->query2Data($r, $tituloFuncion, 'No hay trabajadores disponibles para listar.');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}


function crearUser($usuario, $password1, $email, $dni)
{
    global $db;
    $tituloFuncion = 'crearUsuario';

    try {
        $reg = $db->getSQLRegister("SELECT  name, dni, password from usuarios  where dni=? and email = ? ", array($dni, $email));
        if ($reg) {
            if ($reg['dni'] == $dni) {
                throw new Exception("El DNI ya esta en uso.");
            } else if ($reg['email'] == $email) {
                throw new Exception("El Correo ya esta en uso.");
            }
        }
        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");
        $sql = "INSERT INTO usuarios(name, password, email, dni) VALUES (?,?,?,?)";
        $db->doExecute($sql, array($usuario, password_hash($password1, PASSWORD_DEFAULT), $email, $dni));
        $db->commitTransaction();
        $data = array('estado' => 'success');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->rollbackTransaction();
    }
    return $data;
}

function editarUser($name, $dni, $email, $emailn, $password)
{
    global $db;
    $tituloFuncion = 'Editar Usuario';

    try {
        $reg = $db->getSQLRegister("SELECT  name, dni, password, email from usuarios  where dni=? and email = ? ", array($dni, $email));
        if ($reg) {

            if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");
            $passhash = password_hash($password, PASSWORD_DEFAULT);
            if ($name != '' && $password != '' && $email != '') {
                if ($emailn == $reg['email']) {
                    throw new Exception("El Correo ya esta en uso");
                } else {
                    $db->doExecute("UPDATE usuarios SET name=?, password=?,email=? WHERE dni=?", array($name, $passhash, $dni, $emailn, $dni));
                    $data = array('estado' => 'success');
                }
            } else if ($dni == '') {
                if ($emailn == $reg['email']) {
                    throw new Exception("El Correo ya esta en uso");
                } else {
                    $db->doExecute("UPDATE usuarios SET name=?, password=?,email=? WHERE dni=?", array($name, $passhash, $emailn, $dni));
                    $data = array('estado' => 'success');
                }
            } else if ($password == '') {
                if ($emailn == $reg['email']) {
                    throw new Exception("El Correo ya esta en uso");
                } else if ($emailn == $email) {
                    throw new Exception("El Correo ya esta en uso");
                } else {
                    $db->doExecute("UPDATE usuarios SET name=?, email=? WHERE dni=?", array($name, $emailn, $dni));
                    $data = array('estado' => 'success');
                }
            } else if ($password == '' && $dni == '') {
                if ($emailn == $reg['email']) {
                    throw new Exception("El Correo ya esta en uso");
                } else {
                    $db->doExecute("UPDATE usuarios SET name=?, email=? WHERE dni=?", array($name, $emailn, $dni));
                    $data = array('estado' => 'success');
                }
            } else if ($emailn == '') {
                $db->doExecute("UPDATE usuarios SET name=?, password=? WHERE dni=?", array($name, $passhash, $dni));
                $data = array('estado' => 'success');
            }
            $db->commitTransaction();
            $data = array('estado' => 'success');
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $emailn;
            $_SESSION['dni'] = $dni;
            $_SESSION['password'] = $password;
        }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->rollbackTransaction();
    }
    return $data;
}

function reservar($pista, $hora, $dni)
{
    global $db;
    $tituloFuncion = 'Reservar Pista';

    try {
        $reg = $db->getSQLRegister("SELECT * from reservas where hora=? and pista=? ", array($hora, $pista));

        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");

        if ($reg) {
            if ($reg['reserva'] == 1) {
                throw new Exception("La hora seleccionada no esta disponible");
            } else {
                $db->doExecute('INSERT INTO reservas(pista, hora, reserva, usr_dni) VALUES (?,?,?,?)', array($pista, $hora, 1, $dni));
                $data = array('estado' => 'success');
            }
        } else {
            $db->doExecute('INSERT INTO reservas(pista, hora, reserva, usr_dni) VALUES (?,?,?,?)', array($pista, $hora, 1, $dni));
            $data = array('estado' => 'success');
        }
        $db->commitTransaction();
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->rollbackTransaction();
    }
    return $data;
}

function eliminarReserva($pista, $hora, $dni)
{
    global $db;
    $tituloFuncion = 'Eliminar Reservar';

    try {
        $reg = $db->getSQLRegister("SELECT  pista, hora, usr_dni from reservas  where usr_dni=? and pista=? and hora=?", array($dni, $pista, $hora));
        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");

        if ($reg) {
            if ($reg['pista'] == $pista && $reg['hora'] == $hora && $reg['usr_dni'] == $dni) {
                $db->doExecute('DELETE FROM reservas WHERE (pista =? and hora=? and reserva=? and usr_dni=?)', array($pista, $hora, 1, $dni));
                $data = array('estado' => 'success');
            } else {
                throw new Exception("La hora seleccionada no esta disponible");
            }
        } else {
            $db->doExecute('DELETE FROM reservas WHERE (pista =?, hora=?, reserva=?, usr_dni=?)', array($pista, $hora, 1, $dni));
            $data = array('estado' => 'success');
        }
        $db->commitTransaction();
        // }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->rollbackTransaction();
    }
    return $data;
}
function eliminarReservaADM($pista, $hora)
{
    global $db;
    $tituloFuncion = 'Eliminar Reservar';

    try {
        $reg = $db->getSQLRegister("SELECT  pista, hora, usr_dni from reservas  where pista=? and hora=?", array($pista, $hora));
        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");

        if ($reg) {
            if ($reg['pista'] == $pista && $reg['hora'] == $hora) {
                $db->doExecute('DELETE FROM reservas WHERE (pista =? and hora=? and reserva=? )', array($pista, $hora, 1));
                $data = array('estado' => 'success');
            } else {
                throw new Exception("La hora seleccionada no esta disponible");
            }
        } else {
            $db->doExecute('DELETE FROM reservas WHERE (pista =?, hora=?, reserva=?)', array($pista, $hora, 1));
            $data = array('estado' => 'success');
        }
        $db->commitTransaction();
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->rollbackTransaction();
    }
    return $data;
}

function listarReservas($dni)
{
    global $db;
    $tituloFuncion = 'Listar Reserva';
    try {
        $r = $db->doQuery("SELECT pista as Pista , hora as Hora FROM reservas WHERE usr_dni = ? order by pista", array($dni));
        $data = $db->query2Data($r, $tituloFuncion, 'No hay reservas disponibles');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}
function listarReservasP()
{
    global $db;
    $tituloFuncion = 'Listar Reserva';
    try {
        $r = $db->doQuery("SELECT res.pista as 'Pista' , res.hora as 'Hora' , us.name as 'Usuario' FROM reservas as res left join usuarios as us on us.dni = res.usr_dni order by pista");
        $data = $db->query2Data($r, $tituloFuncion, 'No hay reservas disponibles');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}

function listarReservasAdm()
{
    global $db;
    $tituloFuncion = 'Listar Reserva';
    try {
        $r = $db->doQuery("SELECT res.pista as 'Pista' , res.hora as 'Hora' , us.name as 'Usuario' FROM reservas as res left join usuarios as us on us.dni = res.usr_dni order by pista");
        $data = $db->query2Data($r, $tituloFuncion, 'No hay reservas disponibles');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}

function listarMaquinas()
{
    global $db;
    $tituloFuncion = 'Listar Maquinas';
    try {
        $r = $db->doQuery("SELECT maquina as 'Maquina', ejercicio FROM gimnasio");
        $data = $db->query2Data($r, $tituloFuncion, 'No hay maquinas disponibles');
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->closeQuery($r);
    }
    return $data;
}

function editarMaquina($maquina, $maquinan, $ejercicios)
{
    global $db;
    $tituloFuncion = 'Editar Maquina';
    try {
        $reg = $db->getSQLRegister("SELECT * FROM gimnasio WHERE maquina = ?", array($maquina));
        // echo $maquina;
        if ($reg['maquina'] == $maquina) {
            $db->doExecute('UPDATE gimnasio SET maquina = ? and ejercicio = ?   WHERE maquina = ?', array($maquinan, $ejercicios, $maquina));
            $data = array('estado' => 'success');
        } else {
            throw new Exception("La maquina no se pudo editar");
        }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    }
    return $data;
}

function eliminarMaquina($maquina)
{
    global $db;
    $tituloFuncion = 'Eliminar Maquina';
    try {
        $reg = $db->getSQLRegister("SELECT * FROM gimnasio WHERE maquina = ?", array($maquina));
        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");
        if ($reg) {
            $db->doExecute('DELETE FROM gimnasio WHERE maquina = ?', array($maquina));
            $data = array('estado' => 'success');
        } else {
            throw new Exception("La maquina no existe");
        }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->commitTransaction();
    }
    return $data;
}

function añadirMaquina($maquina, $ejercicios)
{
    global $db;
    $tituloFuncion = 'Añadir Maquina';
    try {
        $reg = $db->getSQLRegister("SELECT * FROM gimnasio WHERE maquina = ?", array($maquina));
        if ($db->beginTransaction() === false) throw new Exception("La BD no pudo iniciar la transacción.");
        if ($reg) {
            throw new Exception("La maquina ya existe");
        } else {
            $db->doExecute('INSERT INTO gimnasio (maquina, ejercicio) VALUES (?, ?)', array($maquina, $ejercicios));
            $data = array('estado' => 'success');
        }
    } catch (Exception $e) {
        $data = array('estado' => 'error', 'errorTitulo' => $tituloFuncion, 'errorMensaje' => $e->getMessage());
    } finally {
        $db->commitTransaction();
    }
    return $data;
}

try {
    $fn = new apiFunction($_POST);
    $funcion = $fn->getFunction();
    $db = new DB($db_host, $db_database, $db_user, $db_password);
    $db->conectarDB();
    if ($fn->checkArgs('doLogin', 'dni', 'password')) {
        $data = $funcion(...$fn->getParametrosAPI());
    } else {
        if ($fn->checkArgs('llistarTelefono')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } else if ($fn->checkArgs('listarTrabajadores')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('crearUser', 'usuario', 'pass1', 'email', 'dni')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('editarUser', 'usuario', 'dni', 'email', 'emailn', 'password')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('reservar', 'pista', 'hora', 'dni')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('listarReservas', 'dni')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('listarReservasP')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('listarReservasAdm')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('eliminarReserva', 'pista', 'hora', 'dni')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('eliminarReservaADM', 'pista', 'hora')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('listarMaquinas')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('editarMaquina', 'maquina', 'maquinan', 'ejercicios')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('eliminarMaquina', 'maquina')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } elseif ($fn->checkArgs('añadirMaquina', 'maquina', 'ejercicios')) {
            $data = $funcion(...$fn->getParametrosAPI());
        } else {
            throw new Exception("La función '$funcion' no está implementada");
        }
    }
} catch (Exception $e) {
    $data = array('estado' => 'error', 'errorTitulo' => 'Llamadas a la API', 'errorMensaje' => $e->getMessage());
    $data['POST'] = $_POST;
} finally {
    $db->desconectarDB();
}
$data['funcion'] = $funcion;
header('Content-type: application/json; charset=utf-8');
echo json_encode($data);
