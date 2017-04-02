<?php

session_start();

require_once('db.inc.php');

setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');


$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));

// filter incoming values
$USUARIO = (isset($_POST['rut'])) ? trim($_POST['rut']) : '';
$PASSWORD = (isset($_POST['PASSWORD'])) ? $_POST['PASSWORD'] : '';
$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'main.php';

if (isset($_POST['submit'])) {


    $query = 'SELECT  Tipo, Usuario_idUsuario FROM Acceso WHERE ' .
         'Login = "' . mysqli_real_escape_string($db, mb_strtoupper($USUARIO)) . '" AND ' .
         'Password = md5("' . mysqli_real_escape_string($db, $PASSWORD) . '")';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);


        $_SESSION['idUs'] = $row['Usuario_idUsuario'];

        $_SESSION['usuario'] = mb_strtoupper($USUARIO);
        $_SESSION['logged'] = 1;
        $_SESSION['nivel'] = $row['Tipo'];




        mysqli_free_result($result);
        mysqli_close($db);
         //echo ' <meta http-equiv="Content-type" content="text/html;charset=UTF-8">';
         header ('Refresh: 0.5; URL=' . $redirect);

        die();
    } else {
        // set these explicitly just to make sure
        $_SESSION['USUARIO'] = '';
        $_SESSION['logged'] = 0;
        $_SESSION['NIVEL'] = 0;

        echo ' <meta http-equiv="Content-type" content="text/html;charset=UTF-8">';
        echo '<script language="javascript">alert("Su usuario o contrase\u00F1a no coinciden.");</script>';
         echo  '<meta http-equiv="Refresh" content="1;url=loginInterno.php">';

    }
    mysqli_free_result($result);


}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Sistema de gestión deportiva</title>

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
        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 text-center">
            <h1 class="logo"><img src="img/logo.png"></h1>
        </div>
        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 caja">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="">RUT, con puntos y guiones</label>
                    <input type="input" class="form-control input-lg"  name="rut" id="rut" placeholder="12.345.678-K">
                </div>
                <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control input-lg" name="PASSWORD" id="PASSWORD" placeholder="">
                </div>
                <input type="hidden" name="redirect" value="<?php echo $redirect ?>"/>

                <button type="submit" name="submit" value="Login"  class="btn btn-primary btn-lg btn-block btn-pass">Ingresar</button>
                <div class="olvido-pass">
                  <a href="" class="pass-perdida"><label>¿Olvidó su contraseña?</label></a>
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
</body>

</html>
