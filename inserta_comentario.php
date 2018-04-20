<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de insercion y consulta de comentarios asociados a las peliculas de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<body>
<?php 
  	require_once "configBD.php";
	$nombre = $_REQUEST["nombre_pelicula"];
	$nu = $_REQUEST["numero_soc"];
	$pass = $_REQUEST["pass"];
	$codigo_peli = $_REQUEST["cod"];
 
	if (isset($_POST['anadir']))
	{
		echo "<form action='./pelicula.php' method='post'>";
		echo "<input type='hidden' name='nombre_pelicula' value='$nombre'>";
		echo "<input type='hidden' name='numero_soc' value='$nu'>";
		echo "<input type='hidden' name='cod' value='$codigo_peli'>";
		echo "<input type='hidden' name='pass' value='$pass'>";
	

		$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
		$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
		$numero_comentarios = "SELECT * FROM comentarios";
		$consulta_numero_comentarios=mysqli_query($conexion,$numero_comentarios) or die(mysqli_error($conexion));

		$id = 0;
		while($row=mysqli_fetch_array($consulta_numero_comentarios,MYSQLI_ASSOC)){
		  $id++;
		}
		$id++;
	
		$texto = $_REQUEST["comentario"];
		$fecha = date("Y-m-j");
		$inserta=mysqli_query($conexion,"INSERT INTO comentarios VALUES ('$id','$texto')");
	
		$inserta_socio_comentario = mysqli_query($conexion,"INSERT INTO relacion_socio_comentario VALUES ('$nu','$id','$fecha')");
	
		$inserta_=mysqli_query ($conexion,"INSERT INTO relacion_pelicula_comentario VALUES ('$codigo_peli','$id','$fecha')");

		mysqli_free_result($consulta_numero_comentarios);
		mysqli_close($conexion);

		echo "<H4>tu comentario ha sido insertado en la base de datos del videoclub</H4>";
		echo "<input type='submit' name='volver' value='Volver'>";
		echo "</form>";
	}
	if (isset($_POST['alquilar']))
	{
		echo "<H3>Alquiler de Películas</H3>";

	
		$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
		$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	
		$datos_socio = "SELECT * FROM socio where Numero_socio = '$nu'";
		$consulta_datos_socio=mysqli_query($conexion,$datos_socio) or die(mysqli_error($conexion));

		$datos_pelicula = "SELECT * FROM peliculas where Codigo_identificador = '$codigo_peli'";
		$consulta_datos_pelicula=mysqli_query($conexion,$datos_pelicula) or die(mysqli_error());
		
		$row = mysqli_fetch_array($consulta_datos_pelicula);
		$alquilada = $row['Alquilada'];
		if ($alquilada == 'no')
		{
			echo "<form action='./alquilar.php' method='post'>";
			echo "<input type='hidden' name='nombre_pelicula' value='$nombre'>";
			echo "<input type='hidden' name='numero_soc' value='$nu'>";
			echo "<input type='hidden' name='cod' value='$codigo_peli'>";
			echo "<input type='hidden' name='pass' value='$pass'>";
		
			echo "<H4>Confirmación de datos para el alquiler de la película</H4>";
			echo "<H5>Compruebe que los dato son correctos, para alquilar la pelicula</H5>";
			
			while($row=mysqli_fetch_array($consulta_datos_socio)){
	  		printf ("<H4>Nombre : <input type='text' value='%s'> \t Primer Apellido : <input type='text' value='%s'> \t Segundo Apellido : <input type='text' value='%s'></H4> \n",$row['Nombre'],$row['Apellido1'],$row['Apellido2']);
	  		printf ("<H4>Numero de cuenta : <input type='text' value='%s'></H4> \n",$row['Cuenta']);
			}
			while($row2=mysqli_fetch_array($consulta_datos_pelicula)){
	  			printf ("<H4>Pelicula a alquilar : <input type='text' value='%s'> \t Genero : <input type='text' value='%s'> \t Año : <input type='text' value='%s'></H4> \n",$row2['Titulo'],$row2['Genero'],$row2['Anio']);
	  			printf ("<H4>Precio : <input type='text' value='%s'>Euros</H4> \n",$row2['Precio']);
			}
			echo "<table><tr><td><br>";
			echo "<input type='submit' name='confirmar' value='Confirmar alquiler'>";
			echo "</form></td>";
			echo "<form action='./pelicula.php' method='post'>";
			echo "<td><input type='submit' name='cancelar' value='Cancelar'></td></tr></table>";
			echo "<input type='hidden' name='nombre_pelicula' value='$nombre'>";
			echo "<input type='hidden' name='numero_soc' value='$nu'>";
			echo "<input type='hidden' name='cod' value='$codigo_peli'>";
			echo "<input type='hidden' name='pass' value='$pass'>";
			echo "</form>";

		}
		else
		{
			echo "<form action='./pelicula.php' method='post'>";
			echo "<input type='hidden' name='nombre_pelicula' value='$nombre'>";
			echo "<input type='hidden' name='numero_soc' value='$nu'>";
			echo "<input type='hidden' name='cod' value='$codigo_peli'>";
			echo "<input type='hidden' name='pass' value='$pass'>";
			$fecha_alquiler = $row['Fecha_devolucion'];
			echo "<H4>Lo sentimos, esta película no puede ser alquilada hasta el día $fecha_alquiler</H4>";
			echo "<input type='submit' name='volver' value='Volver'>";
			echo "</form>";			
		}
		mysqli_free_result($consulta_datos_socio);
		mysqli_free_result($consulta_datos_pelicula);
		mysqli_close($conexion);

	}
	
	
?>
</body>
</html>
