<?php
# Planet VaSlibre
/* -------------------------------------------------------
Script  bajo los términos y Licencia
GNU GENERAL PUBLIC LICENSE
Ver Terminos en:
http://www.gnu.org/copyleft/gpl.html
Desarrollo y Programacion: Hector A. Mantellini (Xombra)
Diseño: Angel Cruz (Abr4xas)

VASLIBRE
http://vaslibre.org.ve
-------------------------------------------------------- */
session_start();
include 'include/config.php';
include 'include/core.php';
if(!empty($_GET["r"]))
{ $urlsitio=trim($_GET["r"]);
  echo '<html lang="'.$lenguaje.'">
  <head><link href="css/redireccion.css" rel="stylesheet" type="text/css" media="all">';
   GoogleAnalytics($UA);
   $enlace=$urlsitio;
   $enlace=$urlplanet.'index.php?r='.$enlace;
   $urlsitio=base64_decode($urlsitio);
   $tok=explode('|',$urlsitio);
   $title=str_replace(' ','-',$tok[1]);
   $urlsitio=$tok[0];
   METAREDIRECCION($nombre_sitio,$descripcion,$latitud,$longitud,$urlplanet,$ExpStr,$glus,$twitter,$lenguaje,$urlsitio,$title,$theme,$enlace);
  echo ' 
  </head><body>';
  flush();
  VER_FEED($urlsitio,$urlplanet,$nombre_sitio,$title,$theme,$enlace);
  echo '</body><html>';
  BUFFER_FIN();
  BORRAR_VARIABLES();
  die();
   }
if (!is_dir("themes/$theme"))
{ $theme='default'; }
$expira=time() - $timecache;
$vidafile= filemtime($urlcache);
VERIFICA_CACHE($urlcache,$expira,$vidafile);
include 'sitemap.php';
echo '<!DOCTYPE html>
<html lang="'.$lenguaje.'">
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="themes/'.$theme.'/css/style.css" rel="stylesheet" type="text/css" media="all">
<title>'.$nombre_sitio.'</title>';
META($nombre_sitio,$descripcion,$latitud,$longitud,$urlplanet,$ExpStr,$glus,$activar,$twitter,$wot,$bing,$yahoo,$google,$alexa,$lenguaje,$theme); 
echo '<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js">
</script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->';
GoogleAnalytics($UA);
?>
<script type="application/javascript">$(function(){$('[data-toggle="tooltip"]').tooltip()})</script>
<script type="application/javascript">
 var auto_refresh=setInterval(
 function () { $('#banner').load('i-publi.php').fadeIn("slow");},5000);</script>
</head>
<body>
<?php
flush();
echo '<noscript><p>Debe habilitar el uso de Javascript, para poder usar muchas de las funciones del sitio</p></noscript>
  <div class="container-fluid">
 <header>';
  include "themes/$theme/header.php";
    echo'
 </header>
     <section>';
         if (!isset($_GET["d"])) {
   include "themes/$theme/content.php"; }
         else 
           { include 'include/politicas.php'; }
     echo'
      </section>
  <footer>';
 include "themes/$theme/footer.php";
        echo'
   </footer>
   <div id="end">';
   COOKIES();
 HCARD($latitud,$longitud,$nombre_sitio,$urlplanet,$ciudad,$provincia,$pais);
 echo'
  </div>
  </div>
  <script defer type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script defer type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script defer type="text/javascript" src="js/js.js"></script>
</body>
</html>';
BUFFER_FIN();
if ($expira >= $vidafile)
  { CREA_CACHE($urlcache,$buffer); }
BORRAR_VARIABLES();
?>
