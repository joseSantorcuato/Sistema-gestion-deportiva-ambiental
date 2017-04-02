<?

include 'db.inc.php';




setlocale(LC_TIME,"es_ES");

mb_internal_encoding('UTF-8');

echo ' <script type="text/javascript" src="js/validarut.js"></script>';

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD,MYSQL_DB) or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, MYSQL_DB) or die(mysqli_error($db));




$CD = (isset($_POST['CD'])) ? $_POST['CD'] : '';

$N1 = (isset($_POST['N1'])) ? $_POST['N1'] : '';
$N2 = (isset($_POST['N2'])) ? trim($_POST['N2']) : '';
$AP= (isset($_POST['AP'])) ? trim($_POST['AP']) : '';
$AM = (isset($_POST['AM'])) ? trim($_POST['AM']) : '';

$RG = (isset($_POST['rut'])) ? $_POST['rut'] : '';

$GE = (isset($_POST['GE'])) ? trim($_POST['GE']) : '';

$DIA = (isset($_POST['DI'])) ? trim($_POST['DI']) : '';
$MES = (isset($_POST['ME'])) ? trim($_POST['ME']) : '';
$ANO = (isset($_POST['AN'])) ? trim($_POST['AN']) : '';

$FECNAC = $ANO."/".$MES."/".$DIA;

$ES = 1;

$DIRE = (isset($_POST['DR'])) ? trim($_POST['DR']) : '';

$PF = (isset($_POST['PF'])) ? trim($_POST['PF']) : '';

$CT1 = (isset($_POST['CT1'])) ? trim($_POST['CT1']) : '';

$CT2 = (isset($_POST['CT2'])) ? trim($_POST['CT2']) : '';

$LOCA = (isset($_POST['CM'])) ? trim($_POST['CM']) : '';

$CDEP = (isset($_POST['CDEP'])) ? trim($_POST['CDEP']) : '';



$encripta = md5($CT1);

$CADU = "2017/12/31";

$DIAS = "MARTES";

$QL = 1;


$FECH = date('Y/m/d');





if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {


  $queryb = "SELECT
  idUsuario, Rut
 FROM
   Usuario
 WHERE
  Rut = '$RG'";
$resultb = mysqli_query($db, $queryb) or die('Error: ' . mysqli_error($db));

$rowb = mysqli_fetch_assoc($resultb);
extract(array($rowb));

if (mysqli_num_rows($resultb) == 1)
{
   echo '<script language="javascript">alert("Usuario existe, comuníquese con un administrador.");</script>';
echo  '<meta http-equiv="Refresh" content="0.5;url=inicio.php">';
 //  die();
}
else{





$query = 'INSERT INTO Usuario
            ( Rut, Nombre, ApPaterno,ApMaterno, Genero, Fecha_Nacimiento, Estado_Usuario, Direccion)
       VALUES
           (' .
            '"' . mysqli_real_escape_string($db, strtoupper($RG))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($N1))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($AP))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($AM))  . '", ' .

             '"' . mysqli_real_escape_string($db, strtoupper($GE))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($FECNAC))  . '", ' .
             '"' . mysqli_real_escape_string($db, strtoupper($ES))  . '", ' .



             '"' . mysqli_real_escape_string($db, strtoupper($DIRE))  . '")';

    $result = mysqli_query($db, $query) or die(mysqli_error($db));


           $queryb = "SELECT
           idUsuario, Rut
          FROM
            Usuario
          WHERE
           Rut = '$RG'";
         $resultb = mysqli_query($db, $queryb) or die('Error: ' . mysqli_error($db));

         $rowb = mysqli_fetch_assoc($resultb);
         extract($rowb);

        if (mysqli_num_rows($resultb) == 0)
        {
            echo '<script language="javascript">alert("Registro no encontrado, se redirigirá a su panel de control.");</script>';
     echo  '<meta http-equiv="Refresh" content="0.5;url=inicio.php">';
          //  die();
        }


        $usuarioRef = $rowb['idUsuario'];






    $querya = 'INSERT INTO Acceso
            ( Login, Password, Tipo, FechaCaducacion, Dias, EstadoAcceso, Usuario_idUsuario)
       VALUES
           (' .
            '"' . mysqli_real_escape_string($db, mb_strtoupper($RG))  . '", ' .
             '"' . mysqli_real_escape_string($db, $encripta)  . '", ' .
             '"' . mysqli_real_escape_string($db, mb_strtoupper($PF))  . '", ' .
             '"' . mysqli_real_escape_string($db, mb_strtoupper($CADU))  . '", ' .
             '"' . mysqli_real_escape_string($db, mb_strtoupper($FECH))  . '", ' .
             '"' . mysqli_real_escape_string($db, mb_strtoupper($ES))  . '", ' .
             '"' . mysqli_real_escape_string($db, mb_strtoupper($usuarioRef))  . '")';

    $resulta = mysqli_query($db, $querya) or die(mysqli_error($db));




    $query = 'INSERT INTO CentroDeportivo_has_Usuario
                (CentroDeportivo_idCentroDeportivo, Usuario_idUsuario)
           VALUES
               (' .
                '"' . mysqli_real_escape_string($db, strtoupper($CDEP))  . '", ' .
                '"' . mysqli_real_escape_string($db, strtoupper($usuarioRef))  . '")';

        $result = mysqli_query($db, $query) or die(mysqli_error($db));


    echo '<script language="javascript">alert("Usuario creado exitosamente.");</script>';

    echo  '<meta http-equiv="Refresh" content="0.5;url=conUsuarios.php">';

    //

  }

  }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Creación de usuarios - Sistema de gestión deportiva</title>

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
            <h2 class="text-center">Creación de usuarios</h2>

        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-md-offset-2">
          <form name="form1" class="form-horizontal" action="creaUsuario.php" onsubmit="return OnSubmitForm();" method = "post">

            <div class="form-group">
                <label for="" class="col-sm-6 control-label">Centro Deportivo*</label>
                <div class="col-sm-6">
                  <select  name="CDEP" id="CDEP">
                                                 <option value="">--Seleccione--</option>

                      <?php


     $selectvalue = $renglon['CDEP'];
             $query = "select idCentroDeportivo, NombreCentroDeportivo from CentroDeportivo";




              $result = mysqli_query($db, $query) or die(mysqli_error($db));


     while($row = mysqli_fetch_array($result))
     {




      $selected = "";
      if($selectvalue==mb_strtoupper($row['NombreCentroDeportivo'])){
          $selected = 'selected';
      }





      echo '<option value="'.$row['idCentroDeportivo'].'" '.$selected.'>'. $row['nom1'].$CHAR. mb_strtoupper($row['NombreCentroDeportivo'])."</option>";


     }
     ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Nombres*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="N1" id="N1"  placeholder="Mario" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Apellido paterno*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="AP" id="AP"placeholder="Rojas">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Apellido materno*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="AM" id="AM" placeholder="Molina">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">RUT(CON PUNTOS, GUIONES Y LETRAS)*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="rut" id="rut" placeholder="12.3456.789-K">
                </div>
            </div>
            <script type="text/javascript">
            function OnSubmitForm()
            {

            return Rut(document.form1.rut.value);



            }

            </script>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Fecha de nacimiento</label>
                <div class="col-sm-6">
                    <select name="DI" id="DI">
                      <option value="0"selected>Día</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                     <option value="11">11</option>
                     <option value="12">12</option>
                     <option value="13">13</option>
                     <option value="14">14</option>
                     <option value="15">15</option>
                     <option value="16">16</option>
                     <option value="17">17</option>
                     <option value="18">18</option>
                     <option value="19">19</option>
                     <option value="20">20</option>
                     <option value="21">21</option>
                     <option value="21">21</option>
                     <option value="22">22</option>
                     <option value="23">23</option>
                     <option value="24">24</option>
                     <option value="25">25</option>
                     <option value="26">26</option>
                     <option value="27">27</option>
                     <option value="28">28</option>
                     <option value="29">29</option>
                     <option value="30">30</option>
                     <option value="31">31</option>
                    </select>

                    <select name="ME" id="ME">
                      <option value="0"selected>Mes</option>
                      <option value="1">Enero</option>
                      <option value="2">Febrero</option>
                      <option value="3">Marzo</option>
                      <option value="4">Abril</option>
                      <option value="5">Mayo</option>
                      <option value="6">Junio</option>
                      <option value="7">Julio</option>
                      <option value="8">Agosto</option>
                      <option value="9">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                    </select>

                    <select name="AN" id="AN">
                      <option value="0"selected>Año</option>
                      <option value="2015">2015</option>
                      <option value="2014">2014</option>
                      <option value="2013">2013</option>
                      <option value="2012">2012</option>
                      <option value="2011">2011</option>
                      <option value="2010">2010</option>
                      <option value="2009">2009</option>
                      <option value="2008">2008</option>
                      <option value="2007">2007</option>
                      <option value="2006">2006</option>
                      <option value="2005">2005</option>
                      <option value="2004">2004</option>
                      <option value="2003">2003</option>
                      <option value="2002">2002</option>
                      <option value="2001">2001</option>
                      <option value="2000">2000</option>
                      <option value="1999">1999</option>
                      <option value="1998">1998</option>
                      <option value="1997">1997</option>
                      <option value="1996">1996</option>
                      <option value="1995">1995</option>
                      <option value="1994">1994</option>
                      <option value="1993">1993</option>
                      <option value="1992">1992</option>
                      <option value="1991">1991</option>
                      <option value="1990">1990</option>
                      <option value="1989">1989</option>
                      <option value="1988">1988</option>
                      <option value="1987">1987</option>
                      <option value="1986">1986</option>
                      <option value="1985">1985</option>
                      <option value="1984">1984</option>
                      <option value="1983">1983</option>
                      <option value="1982">1982</option>
                      <option value="1981">1981</option>
                      <option value="1980">1980</option>
                      <option value="1979">1979</option>
                      <option value="1978">1978</option>
                      <option value="1977">1977</option>
                      <option value="1976">1976</option>
                      <option value="1975">1975</option>
                      <option value="1974">1974</option>
                      <option value="1973">1973</option>
                      <option value="1972">1972</option>
                      <option value="1971">1971</option>
                      <option value="1970">1970</option>
                      <option value="1969">1969</option>
                      <option value="1968">1968</option>
                      <option value="1967">1967</option>
                      <option value="1966">1966</option>
                      <option value="1965">1965</option>
                      <option value="1964">1964</option>
                      <option value="1963">1963</option>
                      <option value="1962">1962</option>
                      <option value="1961">1961</option>
                      <option value="1960">1960</option>
                      <option value="1959">1959</option>
                      <option value="1958">1958</option>
                      <option value="1957">1957</option>
                      <option value="1956">1956</option>
                      <option value="1955">1955</option>
                      <option value="1954">1954</option>
                      <option value="1953">1953</option>
                      <option value="1952">1952</option>
                      <option value="1951">1951</option>
                      <option value="1950">1950</option>
                      <option value="1949">1949</option>
                      <option value="1948">1948</option>
                      <option value="1947">1947</option>
                      <option value="1946">1946</option>
                      <option value="1945">1945</option>
                      <option value="1944">1944</option>
                      <option value="1943">1943</option>
                      <option value="1942">1942</option>
                      <option value="1941">1941</option>
                      <option value="1940">1940</option>
                      <option value="1939">1939</option>
                      <option value="1938">1938</option>
                      <option value="1937">1937</option>
                      <option value="1936">1936</option>
                      <option value="1935">1935</option>
                      <option value="1934">1934</option>
                      <option value="1933">1933</option>
                      <option value="1932">1932</option>
                      <option value="1931">1931</option>
                      <option value="1930">1930</option>
                      <option value="1929">1929</option>
                      <option value="1928">1928</option>
                      <option value="1927">1927</option>
                      <option value="1926">1926</option>
                      <option value="1925">1925</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Género</label>
                <div class="col-sm-6">
                    <select name="GE" id="GE">
                      <option value="">--Seleccione--</option>
                  <option value="FE">Femenino</option>
                  <option value="MA">Masculino</option>
                  <option value="OTG">Otro</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Dirección</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="DR" id="DR"placeholder="Las Rosas 2345 depto 87">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Región</label>
                  <div class="col-sm-6">
                <select name="RG" id="RG">
                  <option value="0">--Seleccione--</option>
              <option value="1">Región Metropolitana</option>

                </select>
              </div>
          </div>
          <div class="form-group">
              <label for="inputEmail3" class="col-sm-6 control-label">Comuna</label>
                <div class="col-sm-6">
              <select name="CM" id="CM">
                <option value="0">--Seleccione--</option>
            <option value="2">Las Condes</option>

              </select>
            </div>
        </div>




            <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label">Contraseña</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="CT1" id="CT1" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-6 control-label">Repetir Contraseña</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="CT2" id="CT2" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-6 control-label">Perfil</label>
                <div class="col-sm-6">
                    <select name="PF" id="PF">
                      <option value="0">--Seleccione--</option>
                      <option value="1">Administrador</option>
                      <option value="2">Monitor deportivo</option>
                      <option value="3">Vecino</option>
                      <option value="4">Otro</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6">
                    <button type="submit" name="submit" value="submit" id ="submit"  class="btn btn-primary">Guardar</button>
                    <button type="submit" class="btn btn-default">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
