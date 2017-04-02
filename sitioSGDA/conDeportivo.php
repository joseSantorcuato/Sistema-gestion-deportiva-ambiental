<?

include 'auth.inc.php';
include 'db.inc.php';
setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');

echo ' <script type="text/javascript" src="js/validarut.js"></script>';

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD,MYSQL_DB) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registro Centros deportivos - Sistema de gestión deportiva</title>

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
            <h2 class="titulo-texto">Registro de centros deportivos</h2>
            <img src="img/usuarios.jpg" class="img-responsive" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 tabla-rec ">
            <form action="">
                <table class="table table-bordered tabla-registro table-hover">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Dirección
                            </th>
                            <th>
                                Comuna
                            </th>
                            <th>
                                Región
                            </th>
                            <th>
                                Encargado
                            </th>
                            <th>
                                Teléfono
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>
                                Acciones
                            </th>
                          </tr>

                    </thead>
                    <?php





  $query = "select idCentroDeportivo, NombreCentroDeportivo, Direccion, Telefono, Localidad_idLocalidad from CentroDeportivo ";
  $result = $db->query($query);

  $num_results = $result->num_rows;?>

  <tbody>
    <?php
     for ($i=0; $i <$num_results; $i++)
{
$row = $result->fetch_assoc();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

?>
                    <tr>

                        <td><?php echo stripslashes(mb_strtoupper($row['idCentroDeportivo']));?></td>

                        <td><?php echo stripslashes(mb_strtoupper($row['NombreCentroDeportivo']));?></td>

                        <td><?php echo stripslashes(mb_strtoupper($row['Direccion']));?></td>

                    <td>
                        LAS CONDES
                    </td>
                    <td>
                        RM
                    </td>
                    <td>
                        CARLOS VÁSQUEZ
                    </td>
                    <td><?php echo stripslashes(mb_strtoupper($row['Telefono']));?></td>

                    <td>
                        <label>
                          <input type="checkbox">
                        </label>
                    </td>
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
                           </tr>
                       </tbody>
                </table>
                <a class="btn btn-primary btn-usuario" href="creaDeportivo.php" role="button">Agregar Centro Deportivo</a>
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
