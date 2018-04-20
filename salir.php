<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Desconexion de los usuarios de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language=javascript>
function cerrar_ventana(){
 window.close()
}
</script>
</head>

<body>
<H3> Desconexión </H3>
<?php 
	session_start();
	header("Location: index.html");
	session_destroy();
?>
</body>
</html>
