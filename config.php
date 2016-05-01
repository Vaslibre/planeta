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

   $theme = 'planetaVaSLibre';   # nombre del theme a usar - tambien esta "default"

# Redes sociales

   $twitter  = 'vaslibre';  # cuenta twitter
   $facebook = '26465149152'; # pagina de facebook
   $youtube  = ''; # canal de youtube
   $glus     = '104909365331295810049'; #pagina de gplus

# Sitio

   $nombre_sitio = 'Planeta VaSlibre';
   $lenguaje     = 'es'; # esp = español | eng = ingles
   $dominio      = 'vaslibre.org.ve';
   $contacto     = 'xombra.com@gmail.com,bullgram@gmail.com'; #direccion para recibir el nuevo feed, si son varias separar por coma
   $emailinfo    = 'webmaster@vaslibre.org.ve'; # direccion email que aparecera en el envio de email (debe existir)
   $principal    = 'vaslibre.org.ve';   # enlace al sitio principal blog | sitio web 

# metatag
   $descripcion  = 'Planeta VaSlibre, los principales FEEDS de sitios GNU Linux, Distribuciones';
   $latitud   = '10.181808';  # buscar en google maps
   $longitud  = '-68.004684'; # buscar en google maps
   $urlplanet = 'http://planeta.vaslibre.org.ve/'; # con / al final
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

   $timecache    = 14400; # 1 horas = 3600 | recomendado 7200 
   $urlcache     = 'cache/index.html';

#  Tiempo máximo que un blog debe tener de la ultima nota publicada
 
  $timenota     = 31536000; # 3600 X 23 X 365 = 1 año

# valores para Feed

    $largo_lectura   = 620;   # cantidad maxima de caracteres de texto por nota en cada feed
    $leer_cant_feed  = 4;     # Mientras mas lea mas tardara en mostrar
    $lang            = 'spa'; # Codigo idioma para el backend.php https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

#
#

# Sitio feed / xml 
	$feeds = array (
        "xombra"          => "http://xombra.com/backend.php",
        "vaslibre"        => "http://vaslibre.org.ve/backend.php",
	    "abr4xas"         => "https://blog.abr4xas.org/feed",
        "xanadu"          => "https://xanadulinux.wordpress.com/feed/",
        "sinfallas"       => "https://sinfallas.wordpress.com/feed/",
        "frikosfera"      => "https://frikosfera.wordpress.com/feed/",
        "cachoycapote"    => "http://www.alvaro.web.ve/feed/",
	    "Mint"            => "http://blog.linuxmint.com/?feed=rss2",
	    "phenobarbital"   => "http://phenobarbital.wordpress.com/feed/",
	    "richzendy"       => "http://www.richzendy.org/feed",
	    "tatica"          => "http://tatica.org/feed/?lang=es",
	    "safecreative"    => "http://resources.safecreative.org/feed/works/latest",
	    "ubuntu"          => "http://www.ubuntu.org.ve/rss.xml",
	    "jjedi"           => "https://jjedixdefault.wordpress.com/feed/",
        "libreofficevzla" => "http://libreoffice.org.ve/feed/",
        "viser"		      => "http://viserproject.com/backend.php",
        "skatox"	      => "http://skatox.com/blog/feed/",
 		"meridaspot"      => "http://meridaspot.blogspot.com/feeds/posts/default/-/ubuntu-ve",
        "ubunlog"         => "http://ubunlog.com/feed/",
        "arawako"         => "http://arawako.com/feed/",
        "linuxadictos"    => "http://www.linuxadictos.com/feed",
        "atareado"        => "http://feedpress.me/atareao",
        "cnti"            => "http://www.cnti.gob.ve/index.php?format=feed&type=rss",
        "moziila-venezuela" => "http://mozillavenezuela.org/feed/",
        "phenobarbita-info" => "http://blog.phenobarbital.info/feed/",
	    "android_libre"   => "http://www.elandroidelibre.com/feed/",
        "desdelinux"      => "http://feeds.feedburner.com/usemoslinux",
		"humanos-uci-cu"  => "http://humanos.uci.cu/feed/",
		"medioslibres"    => "http://medioslibres.org.ve/index.php?format=feed&type=rss",
        "huntingbears"    => "http://feeds.feedburner.com/BlogHuntingBears",
		"losapuntesdetux" => "http://losapuntesdetux.blogspot.com.ar/feeds/posts/default",
        "ernesto_crespo"  => "https://ernestocrespo13.wordpress.com/feed/",
        "jotaeseymas"     => "https://jotaeseymas.wordpress.com/feed/"
	);

 # Publicidad
    $publicidad = array (
        "xombra"     	   	  => "http://xombra.com",
        "abr4xas"  		      => "http://blog.abr4xas.org",
		"vaslibre"         	  => "http://vaslibre.org",
        "viser"               => "http://viserproject.com"
	);

    $ancho = 200;
    $alto  = 324;
?>
