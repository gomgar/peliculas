<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de peliculas novedosas o ultimos estrenos con los que dispondrá la aplicacion pasado un cierto tiempo">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>

<body>
<H3> Novedades </H3>
<?php 
  	require_once "configBD.php";
 $nu = $_REQUEST["numero_soc"];
 $pass = $_REQUEST["pass"];

	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));

	$peliculas_novedades = "SELECT * FROM peliculas WHERE Genero = 'Novedades'";
	$consulta_novedades = mysqli_query($conexion,$peliculas_novedades) or die(mysql_error($conexion));

	if (mysqli_num_rows($consulta_novedades) != 0)
	{
		echo "<form action='./index_registrado.php' method='post'>";	
		echo "<H4>La siguiente semana, pondremos a vuestra disposición las últimas novedades que puedes ver aquí:</H4>";

		echo "<table class=estilo_tabla_pelicula_buscar border=1><tr>";
		echo "<td class=celda_titulo_buscar>Cartel </td><td class=celda_titulo_buscar>Titulo de Película</td><td class=celda_titulo_buscar>Sinopsis </td>";
	
	    while($row=mysqli_fetch_array($consulta_novedades)){
   			echo "</tr><tr>";
		    printf("<td class=celda_link_buscar>%s</td><td class=celda_buscar>%s</td><td class=celda_link_buscar>%s</td>",$row['Cartel'],$row['Titulo'],$row['Sinopsis']);
		}
		echo "</tr></table>"; 
		echo "<input type='hidden' name='numero_soc' value='$nu'>";
		echo "<input type='hidden' name='pass' value='$pass'>";
		echo "<input type='submit' name='volver' value='Volver' class=buscar2>";
		echo "</form>";
	}
	else
	{
		echo "<form action='./index_registrado.php' method='post'>";
		echo "<H4 class=centro>Esta semana no tenemos previsto introducir novedades</H4>";
		echo "<H4 class=centro>Consulte nuestras novedades la siguiente semana</H4>";
		echo "<H4 class=centro>Lo sentimos</H4>";
		echo "<H4 class=centro>Muchas gracias</H4>";
		echo "<input type='hidden' name='numero_soc' value='$nu'>";
		echo "<input type='hidden' name='pass' value='$pass'>";
		echo "<input type='submit' name='volver' value='Volver' style='margin-left:32em; margin-right:32em;'>";
		echo "</form>";
	}
	mysqli_free_result($consulta_novedades);
	mysqli_close($conexion);	
?>
</body>
</html>
