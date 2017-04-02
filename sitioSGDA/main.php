<?php

    error_reporting(E_ALL);
    ini_set('display_errors', true);
session_start();


if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {

   switch ($_SESSION['nivel']){

      case 0:
        //echo "permisos 0";
        break;
        case 1:
        //echo "permisos Administradores";
        header('Location: inicio.php');
        break;
        case 2:
        //echo "permisos Monitor";
         header('Location: inicioMon.php');
        break;
        case 3:
        //echo "permisos Vecino";
         header('Location: inicioVecino.php');
        break;
        case 4:
       // echo "permisos otro";
         header('Location: inicioOtro.php');
        break;






}

?>
 </br>
<?php
}
?>
