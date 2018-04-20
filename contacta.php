<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de contacto a traves de email con los responsables de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language="JavaScript">
function valida_mensaje(){

	if (((formu.mensaje.value).length == 0) || ((formu.asunto.value).length == 0))
	{
			alert("No puede enviar un mensaje vacío \nDebe introducir su mensaje en la caja de texto \ny un tema en el asunto");
			return false;
	}
	document.forms[0].submit(); 
}
</script>
</head>

<body>
<H3> Contácta con nosotros </H3>
<?php 

	$nu = $_REQUEST["numero_soc"];
	$pass = $_REQUEST["pass"];
	echo "<form action='./mensaje_almacenado.php' method='post' name='formu'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
    echo "<input type='hidden' name='pass' value=$pass>";		  													
	echo "<H4>Para contactar con nosotros debes enviarnos un mensaje a nuestra direccion de correo electrónico</H4>";
	echo "<H4>Escribe el asunto y el cuerpo del mensaje en los siguientes cuadros y nos pondremos en contacto contigo lo antes posible.</H4>";
	echo "<H4>Asunto : <input type='text' name='asunto' style='width:41%'></H4>";
	echo "<H4>Texto : &nbsp;&nbsp;</H4>";
	echo "<textarea cols='60' rows='10' name='mensaje' align='center'></textarea>";
	echo "&nbsp;<input type='submit' name='enviar' value='Enviar' onclick='return valida_mensaje();'>";
    echo "</form>";
	
	echo "<form action='./index_registrado.php' method='post' name='formu2'>";
	echo "<input type='hidden' name='numero_soc' value=$nu>";
	
    echo "<input type='hidden' name='pass' value=$pass>";		  													
	echo "<input type='submit' name='volver' value='Volver a la página principal'>";
	echo "<br><br>";
	echo "<p>Muchas gracias</p>";
	echo "<p>Un saludo</p>";
	echo "</form> ";
?>
</body>
</html>
