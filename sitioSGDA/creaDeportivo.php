<?

include 'auth.inc.php';
include 'db.inc.php';
setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD,MYSQL_DB) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));




$ND1 = (isset($_POST['ND1'])) ? $_POST['ND1'] : '';

$DR = (isset($_POST['DR'])) ? $_POST['DR'] : '';
$TE = (isset($_POST['TE'])) ? trim($_POST['TE']) : '';
$LC= 2;


if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
$query = 'INSERT INTO CentroDeportivo
            ( NombreCentroDeportivo, Direccion, Telefono, Localidad_idLocalidad)
       VALUES
           (' .
            '"' . mysqli_real_escape_string($db, strtoupper($ND1))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($DR))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($TE))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($LC))  . '")';

    $result = mysqli_query($db, $query) or die(mysqli_error($db));


    echo '<script language="javascript">alert("Centro deportivo creado exitosamente.");</script>';

    echo  '<meta http-equiv="Refresh" content="0.5;url=inicio.php">';
    //

  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Creación de centros deportivos - Sistema de gestión deportiva</title>

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
            <h2 class="text-center">Creación de centro deportivo</h2>

        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-md-offset-2">
            <form class="form-horizontal" action="creaDeportivo.php" method="POST">


                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Nombre centro deportivo*</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="ND1" id="ND1"  placeholder="Estadio Municipal">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Dirección*</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="DR" id="DR" placeholder="Paul Harris 701 sur">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Comuna*</label>
                    <div class="col-sm-6">
                        <select name="CO" id="CO">
                          <option value="0"selected>---Seleccione comuna---</option>
                         <option value="1">Las Condes</option>


                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Teléfono*</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="TE" id="TE"placeholder="875654321">
                    </div>
                </div>




                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-6">
                        <button type="submit" name="submit" value="submit" id ="submit" class="btn btn-primary">Guardar</button>
                        <button type="submit" class="btn btn-default">Cancelar</button>
                    </div>
                </div>
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
       <script src="js/funciones.js"></script>
</body>

</html>
