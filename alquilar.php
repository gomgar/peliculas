<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="pagina de alquiler de peliculas">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language=javascript>
function invisible(){
		document.getElementById("capa").style.visibility="hidden"
}
function visible(){
		document.getElementById("capa").style.visibility="visible"
}
</script>
</head>

<body onLoad="invisible()">
<H3>Alquiler realizado</H3>

<?php 
	$nombre = $_REQUEST["nombre_pelicula"];
	$nu = $_REQUEST["numero_soc"];
	$pass = $_REQUEST["pass"];
 
 	echo "<form action='./index_registrado.php' method='post'>";
	echo "<input type='hidden' name='numero_soc' value='$nu'>";
	echo "<input type='hidden' name='pass' value='$pass'>";
	echo "<H4>La película $nombre ha sido alquilada con éxito por el socio número $nu</H4>";
	echo "<H4>La película estará alquilada hasta el día";
	?>
	<script>
function haceFecha(f){
   // se contruye un array con los nombres de los meses del año
   meses = new Array ("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio", "Julio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre")         
   dias = new Array ("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo")
   fmes= meses[f.getMonth()]
   fano= f.getYear()
   fdia= f.getDate()

   if ((fdia > 25) && ((fmes == "Enero") || (fmes == "Marzo") || (fmes == "Mayo") || (fmes == "Julio") || (fmes == "Agosto") || (fmes == "Octubre") || (fmes == "Diciembre")))
   {
      fdia = fdia + 6 - 31;
	  if (fmes == "Diciembre")
	  {
	     fmes = "Enero";
	  }
	  else
	  {
		 fmes = fmes + 1;
	  }
   }
   if ((fdia > 24) && ((fmes == "Abril") || (fmes == "Junio") || (fmes == "Septiembre") || (fmes == "Noviembre")))
   {
      fdia = fdia + 6 - 30;
		 fmes = fmes + 1;
   }
   if ((fdia > 22) && (fmes == "Febrero"))
   {
     fdia = fdia + 6 - 28;
	 fmes = fmes + 1;
   }
   if ((fdia > 22) && (fdia <= 25) && ((fmes == "Enero") || (fmes == "Marzo") || (fmes == "Mayo") || (fmes == "Julio") || (fmes == "Agosto") || (fmes == "Octubre") || (fmes == "Diciembre")))
   {
      fdia = fdia + 6;
   }

   if ((fdia > 22) && (fdia <= 24) && ((fmes == "Abril") || (fmes == "Junio") || (fmes == "Septiembre") || (fmes == "Noviembre")))
   {
      fdia = fdia + 6;
   }

   if (fdia <= 22) 
   {
     fdia = fdia + 6;
   }
   return fdia + " de " + fmes 
}
// new Date() toma al fecha actual del ordenador que abre la página
document.write( haceFecha(new Date())       )
// Esta línea concatena la cadena "Hoy es " con el resultado de ejecutar la funcion haceFecha pasándole como referencia la fechha actual del sistema
// La última lina de la funcion devuelve a través del return el resto de la fecha correctamente formateada
</script>
<?php
function suma_fechas($fecha,$ndias) 
{
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))           
              list($dia,$mes,$año)=split("/", $fecha);            
 
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime($mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
            
      return ($nuevafecha);            
}


	echo " inclusive</H4>";
	echo "<H4>Gracias por utilizar nuestros servicios</H4>";
	echo "</form></td>";

	echo "<td><a href='pelicula.cda' onclick='visible()'>Descargar Pelicula</a></td>";

  	require_once "configBD.php";
	$conexion=mysqli_connect($db_host,$db_user,$db_userpass) or die(mysqli_error($conexion));
	$seleccion=mysqli_select_db($conexion,$db_name) or die(mysqli_error($conexion));
	$actualiza_alquiler = "SELECT * FROM peliculas where Titulo='$nombre'";
	$consulta_actualiza_alquiler=mysqli_query($conexion,$actualiza_alquiler) or die(mysqli_error($conexion));

	$alquilada = "si";
	while($row=mysqli_fetch_array($consulta_actualiza_alquiler,MYSQLI_ASSOC)){
		$tit = $row['Titulo'];
		$id = $row['Codigo_identificador'];
		$inserta_alquilada=mysqli_query($conexion,"UPDATE peliculas SET Alquilada='$alquilada' WHERE Titulo='$tit'");
		$fech = date("Y-m-j");

		$ff = suma_fechas($fech, 7);

		$inserta_fecha_devolucion=mysqli_query($conexion,"UPDATE peliculas SET Fecha_devolucion='$ff' WHERE Titulo='$tit'");

		$inserta_relacion_socio_pelicula=mysqli_query($conexion,"INSERT INTO relacion_socio_pelicula VALUES ('$id','$nu','$fech')");
	}
	mysqli_free_result($consulta_actualiza_alquiler);
	mysqli_close($conexion);
	
	echo "<form action='./index_registrado.php' method='post'>";
	echo "<input type='hidden' name='numero_soc' value='$nu'>";
	echo "<input type='hidden' name='pass' value='$pass'>";
	echo "<div id='capa'>";
	echo "<input type='submit' name='fin' value='Finalizar'>";
	echo "</div>";
	echo "</form>";
?>
</body>
</html>
