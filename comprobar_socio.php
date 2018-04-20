<?php
  	require_once "configBD.php";
	$numero = $_REQUEST["numero_soc"];
	$passw = $_REQUEST["pass"];
	
	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	$existe_socio = "SELECT * FROM socio WHERE Numero_socio = '$numero' and Contraseña = '$passw'";
	$consulta_socio = mysqli_query($conexion,$existe_socio) or die(mysqli_error($conexion));

	if (mysqli_num_rows($consulta_socio)!=0)
	{
	    session_start();
	    $autentificado = "SI";
	    header ("Location: ./index_registrado.php?numero_soc=$numero&pass=$passw");
	}
	else 
	{ 
      header("Location: ./error_registro.php");
	}
	mysqli_free_result($consulta_socio);
	mysqli_close($conexion);
?>
<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Pagina de validacion de un socio al entrar en la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>


<body>
</body>
</html>
