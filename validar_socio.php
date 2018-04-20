<html>
<head>
<title> VideoWebClub </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de validacion de un socio de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_pagina_principal.css" type="text/css">
</head>

<body>
<form method="post">
  <?php
    require_once "configBD.php";
$numero = $_REQUEST["numero_soc"];
$passw = $_REQUEST["pass"];
$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
$consulta=mysqli_query($conexion,"select * from socios where Contraseña='$passw' and Numero_socio='$numero'");
if (mysqli_num_rows($consulta) == 0)
	echo "redirigir a error";
else
{
	$row=mysqli_fetch_array($consulta);
	printf ("<H4>Bienvenido %s %s </H4>",$row['Nombre'],$row['Apellido1']);
}
mysqli_free_result($consulta);
mysqli_close($conexion);
?>
  <H1> titulo de la aplicacion </H1>
  <table>
    <tr> 
      <td> 
        <div> 
          <ul>
            <li class=menu> <a class=seccion href="./Accion.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc'];echo "$nu"; ?>" tabindex="1">Acción 
              </a></li>
            <li class=menu> <a class=seccion href="./Comedia.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc'];echo "$nu"; ?>" tabindex="2"> 
              Comedia </a></li>
            <li class=menu> <a class=seccion href="./Drama.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc'];echo "$nu"; ?>" tabindex="3"> 
              Drama </a></li>
            <li class=menu> <a class=seccion href="./Infantil.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc'];echo "$nu"; ?>" tabindex="4"> 
              Infantil </a></li>
            <li class=menu> <a class=seccion href="./Terror.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc'];echo "$nu"; ?>" tabindex="5"> 
              Terror </a></li>
          </ul>
        </div>
      </td>

      <td> 
        <div> 
          <ul>
            <li class=registro> 
              <div> 
                <table>
                  <tr> 
                    <td> 
                      <H4>Sesión del socio nº 
                        <?php
							$numero = $_REQUEST["numero_soc"];
							echo $numero;
						?>
                      </H4>
                    </td>
                  </tr>
                  <tr> 
                    <td> 
                      <input type="submit" name="Entra" value="Desconectar" tabindex="9">
                    </td>
                  </tr>
                </table>
              </div>
            </li>
            <li class=menu> <a class=seccion href="./novedades.php" tabindex="10"> 
              Novedades </a></li>
            <li class=menu> <a class=seccion href="./busqueda.php?pass=<?php echo $passw; ?>&numero=<?php $nu = $_REQUEST['numero_soc']; echo $nu; ?>" tabindex="11"> 
              Busca tu película </a></li>
            <li class=menu> <a class=seccion href="./contacta.php" tabindex="12"> 
              Contacta con nosotros </a></li>
          </ul>
        </div>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
