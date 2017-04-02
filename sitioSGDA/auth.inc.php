<?php
// start or continue session
session_start();

if (!isset($_SESSION['logged'])) {

	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    echo '<script language="javascript">alert("No tiene privilegios para acceder.Será redireccionado para iniciar sesión. ");</script>';
    echo  '<meta http-equiv="Refresh" content="0.5;url=login.php">';
    die();

}
?>
