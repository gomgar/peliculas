<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion donde se muestra el resultado de una busqueda en la base de datos de las peliculas de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
</head>

<body>
<H3> Resultado de la búsqueda </H3>
<?php 
 $nu = $_REQUEST["numero_soc"];
 $pass = $_REQUEST["pass"];
 $genero = $_REQUEST["menu_genero"];
 $precio = $_REQUEST["menu_precio"];
 $anio = $_REQUEST["menu_anio"];

 
 switch ($genero)
 {
 	case "sel":
		$genero_seleccionado = "";
		break;
    case "acc":
		$genero_seleccionado = "Accion";
		break;
    case "com":
		$genero_seleccionado = "Comedia";
		break;
    case "dra":
		$genero_seleccionado = "Drama";
		break;
    case "inf":
		$genero_seleccionado = "Infantil";
		break;
 }

 switch ($precio)
{
    case 1:
		$precio_inf = 0;
		$precio_sup = 0;
		break;
    case 2:
		$precio_inf = 0;
		$precio_sup = 5;
		break;
    case 3:
		$precio_inf = 5;
		$precio_sup = 10;
		break;
    case 4:
		$precio_inf = 10;
		$precio_sup = 15;
		break;
    case 5:
		$precio_inf = 15;
		$precio_sup = 0;
		break;
 }

  	require_once "configBD.php";
	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	
	//solo se ha seleccionado el genero
	if ((!$genero_seleccionado == "") and ($anio == 0) and ($precio_inf == 0 and $precio_sup == 0))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Genero = '$genero_seleccionado'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysqli_error($conexion));
	}
	//solo se ha seleccionado el anio
	if (($genero_seleccionado == "") and (!($anio == 0)) and ($precio_inf == 0 and $precio_sup == 0))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Anio = '$anio'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysqli_error($conexion));
	}
	//solo se ha seleccionado el precio
	if (($genero_seleccionado == "") and ($anio == 0) and (!($precio_inf == 0 and $precio_sup == 0)))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Precio < '$precio_sup' and Precio >= '$precio_inf'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysqli_error($conexion));
	}
	//se ha seleccionado genero y anio
	if ((!$genero_seleccionado == "") and (!($anio == 0)) and ($precio_inf == 0 and $precio_sup == 0))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Anio = '$anio' and Genero = '$genero_seleccionado'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysql_error());
	}
	//se ha seleccionado genero y precio
	if ((!$genero_seleccionado == "") and ($anio == 0) and (!($precio_inf == 0 and $precio_sup == 0)))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Genero = '$genero_seleccionado' and Precio < '$precio_sup' and Precio >= '$precio_inf'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysql_error());
	}
	//se ha seleccionado anio y precio
	if (($genero_seleccionado == "") and (!($anio == 0)) and (!($precio_inf == 0 and $precio_sup == 0)))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Anio = '$anio' and Precio < '$precio_sup' and Precio >= '$precio_inf'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysql_error());
	}
	//se ha seleccionado genero, anio y precio
	if ((!$genero_seleccionado == "") and (!($anio == 0)) and (!($precio_inf == 0 and $precio_sup == 0)))
	{
		$busca_pelicula = "SELECT * FROM peliculas where Anio = '$anio' and Genero = '$genero_seleccionado' and Precio < '$precio_sup' and Precio >= '$precio_inf'";
		$consulta_pelicula = mysqli_query($conexion,$busca_pelicula) or die(mysql_error());
	}

	//no se ha seleccionado ninguna opcion
	if (($genero_seleccionado == "") and ($anio == 0) and ($precio_inf == 0 and $precio_sup == 0))
	{
		echo "<H4>Lo sentimos mucho, no se ha encontrado ninguna pelicula con esas condiciones</H4>";
	}
	else
	{
		if (mysqli_num_rows($consulta_pelicula) !== 0)
		{
			echo "<table class=estilo_tabla_pelicula_buscar border=1><tr>";
		    echo "<H4>Se han encontrado las siguientes películas:</H4>";
		    echo "<td class=celda_titulo_buscar>Titulo</td><td class=celda_titulo_buscar>Enlace </td>";
	
			while($row=mysqli_fetch_array($consulta_pelicula,MYSQLI_ASSOC)){
    			echo "</tr><tr>";
			    printf("<td class=celda_buscar>%s</td><td class=celda_link_buscar><a href='./pelicula.php?numero_soc=$nu&pass=$pass&nombre_pelicula=%s&cod=%s'>Ver pelicula</a>",$row['Titulo'],$row['Titulo'],$row['Codigo_identificador']);
 			}
			echo "</tr></table>"; 
		}
		else
		{
			echo "<H4>Lo sentimos mucho, no se ha encontrado ninguna pelicula con esas condiciones</H4>";
		}
		mysqli_free_result($consulta_pelicula);
		mysqli_close($conexion); 
	}
    echo "<form action='./busqueda.php' method='post'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
    echo "<input type='hidden' name='pass' value=$pass>";		  													
	echo "<input type='submit' name='ir' value='Volver a buscar' class=buscar>";
	echo "</form>";
	echo "<br>";

    echo "<form action='./index_registrado.php' method='post'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
    echo "<input type='hidden' name='pass' value=$pass>";		  													
	echo "<br><br>";
	echo "<input type='submit' name='ir' value='Volver a la página principal' class=buscar>";
	echo "</form>";
?>
</body>
</html>
