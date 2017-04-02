<?php
include 'auth.inc.php';
include 'db.inc.php';


setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD,MYSQL_DB) or
die ('Unable to connect. Check your connection parameters.');

mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));

 $id = $_SESSION['idUs'];

 //  (Fecha, Deporte, NombreCentroDeportivo, DatoSensor_idDatoSensor, Localidad_idLocalidad, Usuario_idUsuario)
 $BN = (isset($_POST['BN'])) ? $_POST['BN'] : '';

 $FECH = date('Y/m/d');

$querya = "SELECT
        CentroDeportivo.idCentroDeportivo, CentroDeportivo.NombreCentroDeportivo, CentroDeportivo.Direccion,CentroDeportivo.Telefono, CentroDeportivo.Localidad_idLocalidad, CentroDeportivo_has_Usuario.CentroDeportivo_idCentroDeportivo, CentroDeportivo_has_Usuario.Usuario_idUsuario
        FROM
        CentroDeportivo, CentroDeportivo_has_Usuario
        WHERE
        CentroDeportivo.idCentroDeportivo = CentroDeportivo_has_Usuario.CentroDeportivo_idCentroDeportivo AND CentroDeportivo_has_Usuario.Usuario_idUsuario = $id";
     $resulta = mysqli_query($db, $querya) or die('Error: ' . mysqli_error($db));
    $rowa = mysqli_fetch_assoc($resulta);
    extract(array($rowa));






$icap;

$calidad;

$rango;

$prueba;


 $query = "SELECT idDatoSensor, MedicionDatoSensor FROM DatoSensor ORDER BY idDatoSensor DESC LIMIT 10";

 $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db));

 $suma=0;

 $reg=10;
 while($sumar=mysqli_fetch_assoc($result))
 {
 $reg=$sumar["idDatoSensor"];
 $suma=$suma+$sumar["MedicionDatoSensor"];


 }







$icap = intval($suma/10);

if ($icap >= 0 && $icap <= 99){

  $calidad = 'BUENA';
  $rango = '0-99';
}

if ($icap >= 100 && $icap <= 199){

  $calidad = 'REGULAR';
  $rango = '99-199';
}

if ($icap >= 200 && $icap <= 299){

  $calidad = 'MALO';
  $rango = '199-299';
}

if ($icap >= 300){

  $calidad = 'PREMERGENCIA SE RECOMIENDA SUSPENSIÓN';
  $rango = '199-299';
}


//echo $icap;

if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {



  $querya = 'INSERT INTO Registro
          (Fecha, Deporte, NombreCentroDeportivo, Icap, Localidad_idLocalidad, Usuario_idUsuario)
          VALUES
              (' .
               '"' . mysqli_real_escape_string($db, mb_strtoupper($FECH))  . '", ' .
                '"' . mysqli_real_escape_string($db, mb_strtoupper($BN))  . '", ' .
                '"' . mysqli_real_escape_string($db, mb_strtoupper($NombreCentroDeportivo))  . '", ' .
                '"' . mysqli_real_escape_string($db, mb_strtoupper($icap))  . '", ' .
                '"' . mysqli_real_escape_string($db, mb_strtoupper($Localidad_idLocalidad))  . '", ' .
                '"' . mysqli_real_escape_string($db, $id)  . '")';


  $resulta = mysqli_query($db, $querya) or die(mysqli_error($db));


  echo '<script language="javascript">alert("Deporte registrado exitosamente.");</script>';



          echo  '<meta http-equiv="Refresh" content="0.5;url=conReg.php">';

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recomendaciones deportivas - Sistema de gestión deportiva</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="row">


        <?php require_once("menu.php") ; ?>


    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2 class="titulo-texto">Recomendaciones deportivas </h2>
            <img src="img/run2.jpg" class="img-responsive" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 tabla-rec">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <h5>Calidad del aire</h5>
                        <p><?php echo $calidad;?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Rango</h5>
                        <p><?php echo $rango;?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h5>Deportes Recomendados</h5>
                        <form action="recDep.php" method="post">

                        <?php

                          if ($icap >= 0 && $icap <= 99){

                          echo' <select multiple class="form-control" name="BN" id="BN" required>
                                <option value="1">Aerobox</option>
                                <option value="2">Básquetbol</option>
                                <option value="3">Fútbol</option>
                                <optionvalue="4">Fútbol Mixto</option>
                                <option value="5">Natación</option>
                                <option value="6">Tenis</option>
                            </select>';
                          }

                          if ($icap >= 100 && $icap <= 299){

                          echo' <select multiple class="form-control" name ="BN" id="BN" required>

                                <option value="8">Gimnasia musculación</option>
                                <option value="9">Mini Tenis</option>
                                <option value="10">Gimnasia de acondicionamiento físico</option>
                                <option value="11">Pilates</option>
                                <option value="12">Yoga</option>
                                <option value="13">Defensa personal</option>
                                <option value="14">Crossfit*</option>
                                <option value="15">Aeroyoga*</option>

                            </select>';
                          }

?>

                    </td>
                </tr>

            </table>
            <button type="submit" name="submit" value="submit" id ="submit" class="btn btn-primary btn-lg btn-block">Practicar deporte</button>
            </form>
        </div>
    </div>

    <footer class="footer text-center foot-copyright">
        <div class="container">
            <p class="text-muted">Copyright 2016. Sistema de gestión deportiva</p>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
