<?php
# Planet VaSlibre
/* -------------------------------------------------------
Script  bajo los términos y Licencia
GNU GENERAL PUBLIC LICENSE
Ver Terminos en:
http://www.gnu.org/copyleft/gpl.html
Desarrollo: Hector A. Mantellini (Xombra)

VASLIBRE
http://vaslibre.org.ve
-------------------------------------------------------- */

#Valores del sistema

# Redes sociales


   $twitter  = 'vaslibre';  # cuenta twitter
   $facebook = '26465149152'; # pagina de facebook
   $youtube  = ''; # canal de youtube
   $glus     = '104909365331295810049'; #pagina de gplus

# Sitio

   $nombre_sitio = 'Planet VaSlibre';
   $dominio      = 'vaslibre.org.ve';
   $contacto     = 'xombra.com@gmail.com'; #direccion para recibir el nuevo feed, si son varias separar por coma
   $emailinfo    = 'webmaster@vaslibre.org.ve'; # direccion email que aparecera en el envio de email (debe existir)

# metatag
   $descripcion  = 'Planeta VaSlibre, los principales FEEDS de sitios GNU Linux, Distribuciones';
   $latitud   = '10.181808';  # buscar en google maps
   $longitud  = '-68.004684'; # buscar en google maps
   $urlplanet = 'http://planet.vaslibre.org.ve/'; # con / al final
   $ciudad    = 'Valencia';
   $provincia = 'Carabobo';
   $pais      = 'Venezuela';
   $postal    = '2001';

# seo 
   $activar = 1;  # 0 desactiva
   $alexa   = '5A6vXOKuR8msgNmH9jEsl3IIWVU';                  # registrarse en http://www.alexa.com/
   $wot     = 'bd1fa12c7dd952ea98e8';                         # registrarse en http://mywot.com/
   $bing    = 'EBCDA2C5F9E226DD58BFAA4BD0D15681';             # registrarse en http://bing.com/ Herramienta Webmaster
   $yahoo   = 'e6cb92c08209d989';				              # registrarse en http://yahoo.com/ Herramienta Webmaster
   $google  = 'mGx5usBCDyvfDVrmqWE7ojt4xaVGF8BMbUTNUOh8gIo';  # registrarse en http://google.com/ Herramienta Webmaster
 
# Google Analytics

   $UA = 'UA-18361732-1';  # Google Analytis registrarse en: https://www.google.com/analytics/

#  Cache del sitio

   $timecache    = 30; # 1 horas = 3600 | recomendado 7200 
   $urlcache     = 'cache/index.html';
  
	//  feeds | RSS 
    # solo 2 para las pruebas luego eliminar y activar el de abajo
 	$feeds = array (
        "xanadu"         	=> "http://xanadulinux.wordpress.com/feed/",
        "xombra"   		    => "http://xombra.com/backend.php"
         

	);  

/*

	$feeds = array (
		"vaslibre"     	 	=> "http://vaslibre.org.ve/backend.php",
		"xombra"   		    => "http://xombra.com/backend.php",
		"Mint"              => "http://blog.linuxmint.com/?feed=rss2",
		"phenobarbital"     => "http://phenobarbital.wordpress.com/feed/rss/",
		"no-photo"         	=> "http://richzendy.org/feed",
		"tatica"         	=> "http://tatica.org/feed/?lang=es",
        "jeidi"             => "https://jeidienwp.wordpress.com/feed/",
		"safecreative"    	=> "http://feeds.feedburner.com/es_blog_safecreative",
		"ubuntu"         	=> "http://www.ubuntu.org.ve/rss.xml",
		"abr4xas"         	=> "http://blog.abr4xas.org/feed",
        "xanadu"         	=> "http://xanadulinux.wordpress.com/feed/",
        "sinfallas"        	=> "http://sinfallas.wordpress.com/feed/"

	); 
*/
?>
