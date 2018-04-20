<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="seccion de busqueda de la pelicula segun ciertos criterios seleccionados">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language="JavaScript">
function valida_busqueda(){

	if (((f1.menu_genero.value)== "sel") && ((f1.menu_anio.value)==0) && ((f1.menu_precio.value)==1))
	{
			alert("Debe seleccionar alguno de los criterios de busqueda");
			return false;
	}
	document.forms[0].submit(); 
}
</script>

</head>

<body class=busqueda>
<H3> Buscador de Películas </H3>
<H4> Selecciona los criterios por los que deseas realizar la búsqueda</H4>
<?php 
 $nu = $_REQUEST["numero_soc"];
 $pass = $_REQUEST["pass"];
 echo "<form action='./resultado_busqueda.php' method='post' name='f1'>";
 echo "<input type='hidden' name='numero_soc' value=$nu>";
 echo "<input type='hidden' name='pass' value=$pass>";		  													
?>
<table class=estilo_busqueda>
	<tr>
		<td class=nombre_dato><H4>Género</H4></td>
		<td>
			<select name="menu_genero">
				<option value="sel">--Selecciona una opcion--</option>
				<option value="acc">Accion</option>
				<option value="com">Comedia</option>
				<option value="dra">Drama</option>
				<option value="inf">Infantil</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class=nombre_dato><H4>Año</H4></td>
		<td>
			<?php
				echo "<select name='menu_anio'>";
				echo "<option value=0>--Selecciona una opcion--</option>";
				$anio = 2005;
				while ($anio >= 1979)
				{
					echo "<option value=$anio>$anio</option>";
					$anio = $anio - 1;
				}
				echo "</select>";
			?>
		</td>
	</tr>
	<tr>
		<td class=nombre_dato><H4>Precio</H4></td>
		<td>
			<select name="menu_precio">
				<option value="1">--Selecciona una opcion--</option>
				<option value="2">Menos de 5 Euros</option>
				<option value="3">Entre 5 y 10 Euros</option>
				<option value="4">Entre 10 y 15 Euros</option>
				<option value="5">Más de 15 Euros</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<input type="submit" name="buscar" value="Buscar" class=buscar onclick="return valida_busqueda()">
			<?php echo "</form>"; ?>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<br>
			<?php 
			  echo "<form action = './index_registrado.php' method='post'>";
		      echo "<input type='hidden' name='numero_soc' value=$nu>";
		      echo "<input type='hidden' name='pass' value=$pass>";
			  echo "<input type='submit' name='volver' value='Volver a la pagina principal' class=buscar2>";
			  echo "</form>";
			?>
		</td>
	</tr>
</table>
</body>
</html>
