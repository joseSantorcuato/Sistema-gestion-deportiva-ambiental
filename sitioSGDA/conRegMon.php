<?php
include 'auth.inc.php';
include 'db.inc.php';


setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD,MYSQL_DB) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));

$calidad;

$FCH1 = (isset($_POST['FCH1'])) ? $_POST['FCH1'] : '';
$FCH2 = (isset($_POST['FCH2'])) ? $_POST['FCH2'] : '';
$CAL = (isset($_POST['CAL'])) ? $_POST['CAL'] : '';


 $id = $_SESSION['idUs'];

$query = "SELECT idDatoSensor, MedicionDatoSensor FROM DatoSensor ORDER BY idDatoSensor DESC LIMIT 10";

$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db));



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Consulta calidad del aire - Sistema de gestión deportiva</title>

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

      <?php require_once("menuMon.php") ; ?>

    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2 class="titulo-texto">Consulta registro actividades deportivas</h2>
            <img src="img/run3.jpg" class="img-responsive" alt="">
        </div>
    </div>
    <?php

  $query = "select idRegistro, Fecha, Deporte, NombreCentroDeportivo, Icap, Localidad_idLocalidad, Usuario_idUsuario from Registro WHERE Usuario_idUsuario = $id ORDER BY idRegistro DESC LIMIT 10";
  $result = $db->query($query);

  $num_results = $result->num_rows;
  ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 tabla-rec">
            <form action="conRegPostMon.php" method="post">
              <div class="modulo-consulta">
              <h3 style="margin-top: 10px;">Consultar fecha</h3>
              <p style="margin-bottom: 36px;">Seleccione las fechas que desea consultar</p>
              <div class="form-group col-md-3" style="padding: 0;">
                <label for="">Fecha 1</label>
                <input type="date" class="form-control" name="FCH1" id="FCH1"  placeholder="yyyy-mm-d" required="true">
              </div>
              <div class="form-group col-md-3" style="padding: 0px 0 0 12px;">
                <label for="">Fecha 2</label>
                <input type="date" class="form-control" name="FCH2" id="FCH2"  placeholder="yyyy-mm-dd" required="true">
              </div>
              <div class="form-group col-md-2">
                <label for="">Calidad del aire</label>
                <select class="form-control" name="CAL" id="CAL" required="true" >
                  <option value="0">Buena</option>
                  <option value="1">Regular</option>
                  <option value="2">Mala</option>
                  <option value="3">Pre emergencia</option>
                  <option value="4">Emergencia</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <button type="submit" name="submit" value="submit" id ="submit"  class="btn btn-primary btn-usuario" style="float: left; margin: 25px 0 0 0;width: 100%;">Consultar</button>
              </div>
            </div>
                <table class="table table-bordered tabla-registro">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                CENTRO DEPORTIVO
                            </th>
                            <th>
                                ICAP
                            </th>
                            <th>
                                Valor ICAP
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Deportes
                            </th>
                            <th>
                                Acciones
                            </th>
                          </tr>

                    </thead>
                    <tbody>

                      <?php
                     for ($i=0; $i <$num_results; $i++)
 {
    $row = $result->fetch_assoc();
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

    if($row['Icap'] >= 0 && $row['Icap'] <= 99){
    $calidad = 'BUENA';

    }

    if($row['Icap'] >= 100 && $row['Icap'] <= 199){
    $calidad = 'REGULAR';

    }

    if($row['Icap'] >= 200 && $row['Icap'] <= 299){
    $calidad = 'MALA';

    }

    if($row['Icap'] >= 300 && $row['Icap'] <= 399){
    $calidad = 'PREMERGENCIA';

    }

    if($row['Icap'] > 399){
    $calidad = 'EMERGENCIA';

    }
$dep;
    switch ($row['Deporte'] ) {
      case '1':
        $dep='AEROBOX';
        break;
        case '2':
        $dep='BÁSQUETBOL';
          break;
        case '3':
        $dep='FÚTBOL';
          break;
        case '4':
        $dep='FÚTBOL MIXTO';
          break;
        case '5':
        $dep='NATACIÓN';
          break;
        case '6':
        $dep='TENIS';    # code...
          break;
        case '7':
          $dep='ERROR REGISTRO, CONTÁCTE A ADMINISTRADOR';    # code...
            break;
        case '8':
        $dep='GIMNASIA MUSCULACIÓN';            # code...
          break;
        case '9':
        $dep='MINI TENIS';              # code...
          break;
        case '10':
          $dep='GIM ACOND FÍSICO';              # code...
          break;

        case '11':
          $dep='PILATES';              # code...
            break;

        case '12':
          $dep='YOGA';              # code...
            break;

        case '13':
          $dep='DEFENSA PERSONAL';              # code...
            break;

        case '14':
          $dep='CROSSFIT';              # code...
          break;

          case '15':
            $dep='AEROYOGA';              # code...
            break;



      default:
        # code...
        break;
    }

    ?>

                      <tr>
                                <td><?php echo stripslashes(mb_strtoupper($row['idRegistro']));?></td>

                                <td><?php echo stripslashes(mb_strtoupper($row['NombreCentroDeportivo']));?></td>

                    <td>
                      <?php echo stripslashes(mb_strtoupper($calidad));?>

                    </td>
                    <td><?php echo stripslashes(mb_strtoupper($row['Icap']));?></td>

                    <td><?php echo stripslashes(mb_strtoupper($row['Fecha']));?></td>

                    <td><?php echo stripslashes(mb_strtoupper($dep));?></td>

                    <td>
                        <a class="btn btn-default btn-xs" href="#" role="button">Editar</a>
                        <a class="btn btn-default btn-xs" href="#" role="button">Eliminar</a>
                    </td>
                    </tr>


                    <?php

                             }

  $result->free();
  $db->close();

?>

                  </tbody>
                </table>

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
