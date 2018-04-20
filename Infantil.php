<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de peliculas de genero infantil, donde podrás elegir y descargar tu preferida">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>

<body>
<H3> Sección Infantil </H3>
<?php
  	require_once "configBD.php";
	$nu = $_REQUEST["numero_soc"];
	$pass = $_REQUEST["pass"];

	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	$consulta=mysqli_query($conexion,'select Codigo_identificador,Genero,Titulo,Cartel from peliculas where Genero="Infantil"');

	echo "<table class=estilo_tabla>";
	$indice = 1;
	printf ("<tr>");
	while($row=mysqli_fetch_array($consulta,MYSQLI_ASSOC)){
	   if ($indice != 4)
	   {
      	  echo "<form action='./pelicula.php' method='post'>";
		  echo "<input type='hidden' name='numero_soc' value=$nu>";
		  echo "<input type='hidden' name='pass' value=$pass>";
		  printf("<td class=estilo_celda><img src='./%s/%s'/></td><td class=estilo_celda>",$row['Genero'],$row['Cartel']);
		  $nombre = $row['Titulo'];
		  printf("<input type='submit' name='ir' value='$nombre' class=link_pelicula></td>");
		  printf("<input type='hidden' name='nombre_pelicula' value='$nombre'>");
		  printf("<input type='hidden' name='cod' value=%s>",$row['Codigo_identificador']);		  
		  echo "</form>";
	 	  $indice++;
	   }
	   else
	   {
      	  printf("</tr><tr>");													
   	   	  echo "<form action='./pelicula.php' method='post'>";
		  echo "<input type='hidden' name='numero_soc' value=$nu>";
		  echo "<input type='hidden' name='pass' value=$pass>";
    	  printf("<td class=estilo_celda><img src='./%s/%s'/></td><td class=estilo_celda>",$row['Genero'],$row['Cartel']);
		  $nombre = $row['Titulo'];
		  echo "<input type='submit' name='ir' value='$nombre' class=link_pelicula></td>";
		  printf("<input type='hidden' name='nombre_pelicula' value='$nombre'>");
		  printf("<input type='hidden' name='cod' value=%s>",$row['Codigo_identificador']);
		  echo "</form>";
	      $indice = 1;
	   }
	}
	printf("</tr></table>");
	mysqli_free_result($consulta);
	mysqli_close($conexion);

	echo "<form action='./index_registrado.php' method='post'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
	echo "<input type='hidden' name='pass' value=$pass>";
	echo "<input class=boton_volver type='submit' name='volver' value='Volver a la página principal'>";
	echo "</form>";
?>
</body>
</html>

