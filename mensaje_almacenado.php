<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion donde se almacenan los mensajes enviados por los socios a la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>

<body>
<H3> pelicula </H3>
<?php
	$tema = $_REQUEST["asunto"];
	$text = $_REQUEST["mensaje"];
	$direccion = 'isabel_alvarez80@yahoo.es';
	mail($direccion,$tema,$text);

	$nu = $_REQUEST["numero_soc"];
	$pass = $_REQUEST["pass"];

	echo "<form action='./index_registrado.php' method='post' name='f'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
    echo "<input type='hidden' name='pass' value=$pass>";		  													

  	require_once "configBD.php";
	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	
	$id_socio = "SELECT Nombre,Apellido1 FROM socios WHERE Numero_socio = '$nu'";
	$consulta_id_socio=mysqli_query($conexion,$id_socio) or die(mysqli_error($conexion));

	$email = "SELECT Email FROM socios WHERE Numero_socio = '$nu'";

	$consulta_email=mysqli_query($conexion,$email) or die(mysqli_error($conexion));

	$numero_mensajes = "SELECT * FROM mensaje";
	$consulta_numero_mensajes=mysqli_query($conexion,$numero_mensajes) or die(mysqli_error($conexion));

	$id = 0;
	while($row=mysqli_fetch_array($consulta_numero_mensajes,MYSQLI_ASSOC)){
	  $id++;
	}
	$id++;

	while($mail=mysqli_fetch_array($consulta_email,MYSQLI_ASSOC)){
	  $b = $mail['Email'];
	}
	if ($b == "NULL")
	{
		echo "Lo sentimos, pero al no disponer usted de dirección de correo electrónico, no puede enviarnos mensajes dado que no podemos ponernos en contacto con usted";
		echo "<input type='submit' name='volver' value='Volver a la pagina principal'>";
	}
	else
	{
		echo "<H4>";
		while($row=mysqli_fetch_array($consulta_id_socio,MYSQLI_ASSOC)){
			printf("%s %s, tu mensaje a sido enviado con éxito",$row['Nombre'],$row['Apellido1']);
		}
		
		echo "<br><br><input type='submit' name='volver' value='Volver a la pagina principal'>";
		
		$cuerpo_mensaje = $_REQUEST["mensaje"];
		$fecha = date("Y-m-j");

		$inserta_mensaje=mysqli_query("INSERT INTO mensaje VALUES ($conexion,'$id','$cuerpo_mensaje')");
	
		$inserta_socio_mensaje = mysqli_query($conexion,"INSERT INTO relacion_socio_mensaje VALUES ('$nu','$id','$fecha')");		
	}

	mysqli_free_result($consulta_email);
	mysqli_free_result($consulta_id_socio);
	mysqli_free_result($consulta_numero_mensajes);
	mysqli_close($conexion);

	echo "</form> ";
?>
</body>
</html>
