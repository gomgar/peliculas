<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion donde se encuentran todos los datos relativos a una determinada pelicula de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language="JavaScript">

function visible(){
	document.getElementById("capa_ver").style.visibility="visible"
	document.getElementById("capa_poner").style.visibility="hidden"
	document.getElementById("boton_cerrar").style.visibility="visible"
}
function insertaComentario(){
	
	document.getElementById("capa_poner").style.visibility="visible"
	document.getElementById("capa_ver").style.visibility="hidden"
	document.getElementById("boton_cerrar").style.visibility="hidden"
}
function oculta_añadir_comentario(){
	
	document.getElementById("capa_poner").style.visibility="hidden"
}
function invisible(){
		document.getElementById("capa_poner").style.visibility="hidden"
		document.getElementById("capa_ver").style.visibility="hidden"
		document.getElementById("boton_cerrar").style.visibility="hidden"
}
function invisible2(){
		document.getElementById("capa_poner").style.visibility="hidden"
}
function valida_comentario(){

	if ((formulario.comentario.value).length == 0)
	{
			alert("Debe introducir su comentario en la caja de texto");
			return false;
	}
	document.formulario.submit(); 
}
</script>
</head>

<body onLoad="invisible()">
<?php
  	require_once "configBD.php";

	$nu = $_REQUEST["numero_soc"];
	$codigo_peli = $_REQUEST["cod"];
	$pass = $_REQUEST["pass"];
	$pelicula = $_REQUEST["nombre_pelicula"];
	
	echo "<H3>Película : '$pelicula' </H3>";

	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));

  	$busca_pelicula="SELECT * FROM peliculas where Titulo = '$pelicula'";
	$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysqli_error($conexion));

	echo "<form method='post' action='./inserta_comentario.php' name='formulario'>";
	echo "<input type='hidden' name='nombre_pelicula' value='$pelicula'>";
	echo "<input type='hidden' name='numero_soc' value='$nu'>";
	echo "<input type='hidden' name='cod' value='$codigo_peli'>";
	echo "<input type='hidden' name='pass' value='$pass'>";

	echo "<table class=estilo_tabla_pelicula border=1>";
	echo "<tr>";

	while($row=mysqli_fetch_array($consulta_pelicula,MYSQLI_ASSOC)){
    	printf("<td class=celda_titulo>Cartel</td><td class=celda_titulo>Género</td><td class=celda_titulo>Año</td><td class=celda_titulo>Duración</td><td class=celda_titulo>Sinópsis</td><td class=celda_titulo>Precio</td>");
	    echo "</tr><tr>";
	    printf("<td class=celda><img src='./%s/%s'/></td><td class=celda>%s</td><td class=celda>%d</td><td class=celda>%d&nbspmin</td><td class=desc><textarea cols='50' rows='12' style='background-color:#FFFF99; border-width:0px'>%s</textarea></td><td class=celda>%d&nbspEuros</td>",$row['Genero'],$row['Cartel'],$row['Genero'],$row['Anio'],$row['Duracion'],$row['Sinopsis'],$row['Precio']);
	}  
	mysqli_free_result($consulta_pelicula);
	mysqli_close($conexion);
	echo "</tr></table>";
	echo "<br>";
	echo "<input type='button' onclick='visible()' value='Ver Comentarios' name='b1'>&nbsp;<input type='button' name='inserta_comentario' value='Añadir Comentario' onclick='insertaComentario()'>";
	echo "&nbsp;<input type='submit' float='right' name='alquilar' value='Alquilar Película'>";

	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));

	
	$codigo_peli = $_REQUEST["cod"];
	$nu = $_REQUEST["numero_soc"];
	
	$numero_comentarios = "SELECT * FROM comentarios c, relacion_pelicula_comentario r where r.Codigo = c.Codigo and r.Codigo_identificador = '$codigo_peli'";
	$consulta_numero_comentarios=mysqli_query($conexion,$numero_comentarios) or die(mysqli_error($conexion));


	$comentarios = "SELECT co.Texto,rel.Fecha, soc.Nombre,soc.Apellido1 FROM comentarios co,relacion_pelicula_comentario rel, relacion_socio_comentario rel2, socio soc where rel.Codigo = co.Codigo and rel.Codigo = rel2.Codigo and rel.Codigo_identificador = '$codigo_peli' and rel2.Numero_socio = soc.Numero_socio ORDER BY rel.Fecha";
	$consulta_comentarios = mysqli_query($conexion,$comentarios) or die(mysqli_error($conexion));
	
	echo "<br><br>";
	echo "<textarea class=ver_coment id='capa_ver' name='ver' cols='50' rows='5'>";
	$num = 0;
	while($filas=mysqli_fetch_array($consulta_numero_comentarios,MYSQLI_ASSOC)){
	  $num++;
	}
	

	if ($num != 0) //mysql_num_rows($consulta_numero_comentarios) != 0)
	{
		while($registro=mysqli_fetch_array($consulta_comentarios,MYSQLI_ASSOC)){

			printf("--------------------------------------------------\n");
			printf("Fecha: %s\n",$registro['Fecha']);
			printf("Autor: %s %s\n",$registro['Nombre'],$registro['Apellido1']);
			printf("Comentario: %s\n",$registro['Texto']);
		}
		printf("--------------------------------------------------\n");
	}
	else
	{
		echo "No existen comentarios asociados a la película";
	}
	echo "</textarea>";
	
	mysqli_free_result($consulta_comentarios);
	mysqli_close($conexion);
	echo "<input type='button' id='boton_cerrar' name='cerrar' value='Cerrar' onclick='invisible()'>";

	echo "<div id='capa_poner' class=poner_coment>";
	echo "<H4>Añade a continuación tu comentario &nbsp;&nbsp;<input type='submit' name='anadir' value='Añadir' onclick='return valida_comentario();'>";
	echo "&nbsp;<input type='button' name='cancelar' value='Cancelar' onclick='oculta_añadir_comentario()'></H4>";
	echo "<textarea id='capa_poner' cols='50' rows='5' name='comentario'></textarea>";
	echo "</div>";
	echo "</form>";

	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));

	$codigo_peli = $_REQUEST["cod"];
	$genero_peli = "SELECT Genero FROM peliculas where Codigo_identificador = '$codigo_peli'";
	$consulta_genero=mysqli_query($conexion,$genero_peli) or die(mysqli_error($conexion));

	$fila=mysqli_fetch_array($consulta_genero,MYSQLI_ASSOC);

	echo "<div class='volver'>";
	echo "<form method='post' action='./";
	echo $fila['Genero'];
	echo ".php' name='formulario2'>";
	echo "<input type='hidden' name='nombre_pelicula' value='$pelicula'>";
	echo "<input type='hidden' name='numero_soc' value='$nu'>";
	echo "<input type='hidden' name='cod' value='$codigo_peli'>";
	echo "<input type='hidden' name='pass' value='$pass'>";
	echo "<br><input type='submit' name='volver' value='Volver a la sección'></div>";
	mysqli_free_result($consulta_genero);
	mysqli_close($conexion);
	echo "</form>";
?>
</body>
</html>
