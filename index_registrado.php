<html>
<head>
<title> VideoWebClub </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta autor="Isabel �lvarez Fuentes">
<meta name="Copyright" xml:lang="es" content="&copy; Isabel Alvarez Fuentes" />
<meta name="Description" content="Pagina de inicio de la aplicacion para un usuario registrado y conectado con exito">
<meta name="Language" content="Spanish">
<link rel="stylesheet" href="./estilos/estilo_pagina_principal.css" type="text/css">
</head>

<body>
<div class=caja_fecha> 
  <script>
function haceFecha(f){
   // se contruye un array con los nombres de los meses del a�o
   meses = new Array ("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio", "Julio", "Agosto", "Septiembre","Octubre", "Noviembre", "Diciembre")         
   dias = new Array ("Lunes", "Martes", "Mi�rcoles", "Jueves", "Viernes", "S�bado", "Domingo")
   fmes= meses[f.getMonth()]
   fano= f.getYear()
   fdia= f.getDate()
   fdias = dias[f.getDay()]
   return fdias + " " + fdia + " de " + fmes 
}
// new Date() toma al fecha actual del ordenador que abre la p�gina
document.write( haceFecha(new Date())       )
// Esta l�nea concatena la cadena "Hoy es " con el resultado de ejecutar la funcion haceFecha pas�ndole como referencia la fechha actual del sistema
// La �ltima lina de la funcion devuelve a trav�s del return el resto de la fecha correctamente formateada
</script>
</div>
<OBJECT width="400" height="400">
  <PARAM NAME="movie" VALUE="./pelicula_g.swf">
  <EMBED SRC="./pelicula_g.swf" width="550" height="70" padding-left="0px" margin-left="0px">
  </EMBED> 
</OBJECT> 
<?php
	$numero = $_REQUEST["numero_soc"];
	$passw = $_REQUEST["pass"];
?>
<table>
  <tr> 
    <td> 
      <div> 
        <ul>
          <li class=elemento_seccion_izq> 
            <form action='./Accion.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Accion" class=boton2>
            </form>
          </li>
          <li class=elemento_seccion_izq> 
            <form action='./Comedia.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Comedia" class=boton2>
            </form>
          </li>
          <li class=elemento_seccion_izq> 
            <form action='./Drama.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Drama" class=boton2>
            </form>
          </li>
          <li class=elemento_seccion_izq> 
            <form action='./Infantil.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Infantil" class=boton2>
            </form>
          </li>
        </ul>
      </div>
    </td>
    <td class=descripcion_registrado> 
      <h2><i>&nbsp;Bienvenidos al mundo del cine en casa !!</i></h2>
      <p>Tenemos la mejor selecci&oacute;n de cine al alcance de tu mano. Aqu&iacute; 
        podr&aacute;s encontrar una amplia gama de peliculas de todos los g&eacute;neros 
        , pensadas s&oacute;lo para ti.</p>
      <p>Para beneficiarte de nuestros servicios s&oacute;lo necesitas registrarte. 
        Si a&uacute;n no lo has hecho, a que estas esperando....no lo pienses 
        m&aacute;s, <a href='./index_registrado.php' style='color:red;font-size:130%;font-style:italic' tabindex='6'> 
        Registrate!</a></p>
      <p>Te ofrecemos una amplia gama de pel�culas, de las m�s selectas. Cada 
        alquiler tiene una duraci�n de una semana.</p>
      <p>Cada semana te informamos sobre las �ltimas pel�culas y novedades que 
        pondremos a tu disposici�n la semana siguiente a la publicaci�n de dicha 
        informaci�n.</p>
      <p>Si tu pelicula no esta disponible puedes ponerte en contacto con nostros 
        mand�ndonos un e-mail e intentaremos solucionar tu problema lo antes posible.</p>
      <p>Podr�s consultar los comentarios que han realizada los distintos socios 
        sobre las pel�culas que han visto, y as� poder guiarte un poco mejor en 
        tu elecci�n.</p>
      <p>Disponemos tambien de un buscador de pel�culas, para facilitarte la b�squeda 
        de la pel�cula que buscabas hace tiempo y no encontrabas. </p>
      <p>Esperamos que disfrutes con nuestras peliculas.</p>
      <p align='right'>&nbsp; &nbsp;(the audience is listening)</p>
    </td>
    <td> 
      <div> 
        <ul>
          <li class=registro> 
            <div> 
              <table>
                <tr> 
                  <td> <br>
                    <H4>Socio nº 
                      <?php echo $numero; ?>
                    </H4>
                  </td>
                </tr>
                <tr> 
                  <td> 
                    <?php
				    echo "<form action='./salir.php?numero_soc=$numero' method='post'>";
                    echo "<input type='submit' name='Entra' value='Desconectar' tabindex='9'>";
                    echo "</form>";
				  ?>
                  </td>
                </tr>
              </table>
            </div>
          </li>
          <li class=elemento_seccion_dch> 
            <form action='./Novedades.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Novedades" class=boton2>
            </form>
          </li>
          <li class=elemento_seccion_dch> 
            <form action='./busqueda.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Buscador" class=boton2>
            </form>
          </li>
          <li class=elemento_seccion_dch> 
            <form action='./contacta.php' method='post'>
              <input type='text' name='pass' class=elemento_menu value=<?php echo $passw; ?> >
              <input type='text' name='numero_soc' class=elemento_menu value=<?php echo $numero; ?> >
              <input type="submit" value="Contacto" class=boton2>
            </form>
          </li>
        </ul>
      </div>
    </td>
  </tr>
</table>
</body>
</html>
