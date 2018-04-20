<html>
<head>
<title> VideoWebClub - Accion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel Álvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Seccion de registro de los usuarios como socios de la aplicacion">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_secciones.css" type="text/css">
<script language="JavaScript">
function esVacio(a)
{
	if (a==null || a=="")
		return true
}
function esEmail (s){
	
   if (s.indexOf("@") != s.lastIndexOf("@")  )  // error si mas de una arroba 
		return false

    posArroba=  s.indexOf("@")           //Posicion de la arroba
    posPunto= s.lastIndexOf(".")	 //Posicion del ultimo punto del mail
    

    if ( posArroba+2  >= posPunto)
		return false			  // No hay dos caracteres entre punto y arroba
	
    if (posPunto+5 <= s.length  || posPunto+2==s.length)
    {
		alert("El dominio no es correcto");
		return false			  // El dominio tiene menos de 2 caracteres o mas de 3
    }
	
	return true
}
function validaFormulario(){

    ////////////////// COMPRUEBA SI LAS CAJAS ESTAN VACÍAS
    //	La coleccion element de un forulario contiene todos los elementos de un formulario.
    //  A través del índice de elements[], se puede acceder a todos los elementos del formulario independientemente
    //  de su name o id.

	for (f=0; f<(document.forms.f1.length)-1 ; f++)
      {
		if ((f1.elements[f].value=="") && (f != "5") && (f !="4"))
            {
			alert("Debe rellenar todos los campos obligatorios(*)")
			return false
		}
	}
	if (isNaN(f1.dni.value))
	{
		alert("El dni debe ser un número, sin la letra final");
		return false;
	}
	else
	{
		if ((f1.dni.value).length != 8)
		{
			alert("Numero erróneo de dígitos del dni\n (Rellene con ceros por la izquierda para formar 8 digitos)")
			return false
		}
	}
	if (isNaN(f1.tlf.value))
	{
		alert("El telefono debe ser un numero")
		return false
	}
	else
	{
		if (((f1.tlf.value).length != 9) && ((f1.tlf.value).length != 0))
		{
			alert("Numero de dígitos del teléfono incorrecto")
			return false
		}
	}
	//if (esVacio(f1.mail.value))
	//{
	//	alert("La dirección de correo no es correcta");
	//	return false;
	//}
	//else
	if (! esVacio(f1.mail.value))
	{
		if (! esEmail(f1.mail.value))
		{
			alert("La dirección de correo es incorrecta\n Debe tener el formato: xxx@xxx.xx ó xxx@xxx.xxx")
			return false
		}
	}
	if (isNaN(f1.cuenta1.value) || isNaN(f1.cuenta2.value) || isNaN(f1.cuenta3.value) || isNaN(f1.cuenta4.value))
	{
		alert("El número de cuenta debe ser un número y tener el formato:\nEntidad - Oficina - D.C. - Numero Cuenta ");
		return false;
	}
	else
	{
		if ((f1.cuenta1.value).length != 4)
		{
			alert("El numero de Entidad (1º) es incorrecto");
			return false;
		}
		if ((f1.cuenta2.value).length != 4)
		{
			alert("El numero de Oficina (2º) es incorrecto");
			return false;
		}
		if ((f1.cuenta3.value).length != 2)
		{
			alert("El numero de D.C. (3º) es incorrecto");
			return false;
		}
		if ((f1.cuenta4.value).length != 10)
		{
			alert("El numero de cuenta bancaria (4º) es incorrecto");
			return false;
		}
	}
	if ((f1.password.value) != (f1.password2.value))
	{
		alert("Las contraseñas no coinciden");	
		return false;
	}	
	else
		return true;
	document.forms[0].submit(); 
}
</script>
</head>

<body>
<H3> Registro </H3>
<form action="./exito_registro.php"  method="post" onSubmit="return validaFormulario()" name="f1">
<H4>	Rellene sus datos personales: </H4>
<table class=tabla_registro>
	<tr>
		<td class=nombre_dato> Nombre (*) </td>
		<td> <input class=caja_texto name="nombre"> </td>
		<td class=nombre_dato> Apellido 1 (*)</td>
		<td> <input class=caja_texto name="apellido1"> </td>
		<td class=nombre_dato> Apellido 2 (*)</td>
		<td> <input class=caja_texto name="apellido2"> </td>
	</tr>
	<tr>
		<td class=nombre_dato> Nº DNI (*)</td>
		<td> <input class=caja_texto type="text" name="dni" maxlength="9"> </td>
		<td class=nombre_dato> Teléfono </td>
		<td> <input class=caja_texto type="text" name="tlf"> </td>
		<td class=nombre_dato> E-mail </td>
		<td> <input class=caja_texto type="text" name="mail"> </td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td class=numero_cuenta> Numero de cuenta bancaria (*)</td>
		<td> <input type="text" name="cuenta1" maxlength="4" size="4"> - <input type="text" name="cuenta2" maxlength="4" size="4"> - <input type="text" name="cuenta3" maxlength="2" size="2"> - <input type="text" name="cuenta4" maxlength="10" size="10"> </td>
	</tr>
</table>
<br><br>
<H4>	Introduzca la contraseña con la que desea acceder al sistema</H4>
<H4>  Contraseña (*): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="password" name="password"></H4>
<H4>	Confirmar contraseña (*):  <input type="password" name="password2"></H4>
<table class=botones>
	<tr>
		<td class=boton1>
			<input type="submit" value="Registrar" name="submit">
		</td>
		<td class=boton2>
			<a href="./index.html"> Volver a la página principal </a>
		</td>
	</tr>
</table>
</form>
</body>
</html>
