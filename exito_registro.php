<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Pagina de exito al registrarse como nuevo socio en la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>

<body>
<H3> Exito en el Registro </H3>
<?php 
  	require_once "configBD.php";
 	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	$numero_socios = "SELECT * FROM socio";
	$consulta_numero_socios=mysqli_query($conexion,$numero_socios) or die(mysqli_error($conexion));
	
	if (mysqli_num_rows($consulta_numero_socios) == 0)
		$id = mysqli_num_rows($consulta_numero_socios) + 1;
	else
		$id = mysqli_num_rows($consulta_numero_socios) + 1;


	$nombre = strip_tags($_POST["nombre"]);
	$ap1 = strip_tags($_POST["apellido1"]);
	$ap2 = strip_tags($_POST["apellido2"]);
	$dni = strip_tags($_POST["dni"]);
	$tlf = strip_tags($_POST["tlf"]);
	$email = strip_tags($_POST["mail"]);
	$cuenta1 = strip_tags($_POST["cuenta1"]);
	$cuenta2 = strip_tags($_POST["cuenta2"]);
	$cuenta3 = strip_tags($_POST["cuenta3"]);
	$cuenta4 = strip_tags($_POST["cuenta4"]);
	$contrasena = strip_tags($_POST["password"]);
	$cuenta = $cuenta1.$cuenta2.$cuenta3.$cuenta4;

	echo "<H4> ENHORABUENA, ";
	echo "$nombre";
	echo "&nbsp";
	echo "$ap1";
	echo "</H4>";
	echo "<H4> HAS SIDO REGISTRADO EN EL SISTEMA </H4>";
	echo "<H4> TU NUMERO DE SOCIO ES EL  <input type='text' name='numero' value='$id'></H4>";

	if ($email == "")
	{
	  $email = "NULL";
	}
	$inserta = mysqli_query($conexion,"INSERT INTO socio VALUES ('$id','$nombre','$ap1','$ap2','$dni','$tlf','$email','$cuenta','$contrasena')");
	mysqli_free_result($consulta_numero_socios);
	mysqli_close($conexion);

?>

<H4> Gracias por utilizar nuestros servicios </H4>
<H4> Vuelve a la página principal y registrate en el sistema </H4>
<p align="center"><a href="./index.html"> Volver a la página principal </a></p>
</body>
</html>
