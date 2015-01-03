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

ENCABEZADO();
LIMPIAR_VALORES();
$buffer = BUFFER_INICIO();
VERIFICA_CACHE($urlcache,$timecache,$buffer);

function BORRAR_VARIABLES()
{ $_GET = $_POST = array(); 
  unset($_POST,$_GET);
return;
}

function BUFFER_INICIO()
{ $buffer = ob_start("compress_page");
  return $buffer;
}

function BUFFER_FIN()
{ ob_flush();
  BORRAR_VARIABLES();
 return;
}

function COOKIES()
{ echo '
 <div class="contcookies" style="display: none;">Este sitio, como la mayoría, usa cookies. Si sigues navegando entendemos que acepta las politicas de uso. <a href="#" class="cookiesaceptar">Aceptar</a></div>';
return;
}

function COMPRESS_PAGE($buffer) 
{ $search  = $replace = array(); 
  $search  = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
  $replace = array(">","<",'\\1');
  return trim(preg_replace($search, $replace, $buffer)); 
}

function CREA_CACHE($urlcache,$timecache,$buffer)
{  ob_end_flush();
   $filecached = fopen($urlcache, 'w');
   $contenido = COMPRESS_PAGE(ob_get_contents());
   fwrite($filecached, $contenido);
   fclose($filecached);  

return;
}

function DECODE($origen) {
 $origen = html_entity_decode($origen, ENT_QUOTES, "UTF-8");
 $origen = htmlspecialchars($origen, ENT_QUOTES, "UTF-8");
return $origen;
}

function ENCABEZADO(){
  global $ExpStr;
  header('Accept-Ranges: bytes');
  $tiempo =  $_SERVER['REQUEST_TIME'] + 7200;
  $ExpStr = 'Expires: '.gmdate("D, d M Y H:i:s", $tiempo) . " GMT"; 
  session_cache_limiter('private_no_expire');
  session_cache_expire(7200);
  header($ExpStr); 
  header("Cache-Control: maxage=$tiempo"); 
  header("Cache-Control: public, must-revalidate");
  header("Cache-Control: public");
  header("pragma: public"); 
  header("Content-Transfer-Encoding:gzip;q=1.0, identity; q=0.5, *;q=0"); 
  header("Cache-Control: cache");  
  header("Pragma: cache");
  header("Content-Type: text/html; charset=UTF-8");
  $etag = md5($_SERVER['REQUEST_URI'] . $ExpStr);
  header("Etag: $etag");
return $ExpStr;
}

function HCARD() {
echo '<div id="hcard-Xanadu Linux" class="vcard"> 
	   <span class="fn n"><span class="given-name">Planeta VaSlibre</span> 
	   </span>
           <div class="org">Planeta VaSlibre</div> 
	   <div class="adr">
             <span class="locality">Valencia</span>,
             <span class="region">Carabobo</span>, 
	     <span class="country-name">Venezuela</span>,
             <span class="postal-code">2001</span> 
           </div> 
           <div class="url"><a href="http://vaslibre.org.ve/planet/" 
                title="Planeta VaSlibre">http://vaslibre.org.ve/planet/</a>
           </div>
	   <div class="geo">GEO: 
	    <span class="latitude">10.181808</span>, 
	    <span class="longitude">-68.004684</span>
	   </div>
      </div>';
return;
}

function META()
{ echo '
    <meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9, IE=8, IE=7, chrome=1, IE=edge" />
    <meta name="owner" content="VaSlibre">
	<meta name="resource-type" content="document" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="VaSlibre" />
	<meta name="revisit-after" content="5 days" />
	<meta name="revisit" content="1" />
	<meta name="distribution" content="Global" />
	<meta name="generator" content="Aptana" />
	<meta name="rating" content="General" />
	<meta name="country" content="Venezuela" />
	<meta name="language" content="es_ES" />
	<meta name="adblock" content="disable" />
	<meta name="advertising" content="ask" />
	<meta name="dc.title" content="Planeta Vaslibre" />
	<meta name="dc.date" content="'.date("Y-m-d",$_SERVER['REQUEST_TIME']).'" />
	<meta name="dc.format" content="text/html" />
	<meta name="dc.language" content="es_ES" />
	<meta name="geo.region" content="VE-G" />
	<meta name="geo.placename" content="Valencia" />
	<meta name="geo.position"  content="10.181808;-68.004684" />
	<meta name="icbm" content="10.181808;-68.004684" />
	<meta name="keywords" content="Planeta,VaSlibre,RSS,Feed,Agregador,Xanadu,Xanadu Linux,sinfallas,xombra,viserproject,gnu,linux,keyword,keyword,WOT_keyword" />
	<meta name="description" content="Planeta VaSlibre, los principales FEEDS de sitios GNU Linux, Distribuciones" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/" />
	<meta name="medium" content="mult" />
	<meta http-equiv="pragma" content="cache" />
	<meta http-equiv="cache-control" content ="cache" />
	<meta http-equiv="vary" content="content-language" />
	<link rel="apple-touch-icon" href="img/apple.png" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Planeta vaSlibre" />
	<meta property="og:description" content="Una excelente distribución pensada para ser rápida, ligera y segura..." />
	<meta property="og:url" content="http://vaslibre.org.ve/planet/" />
	<meta property="og:site_name" content="Planeta VaSlibre" />
	<meta property="og:image" content="http://vaslibre.org.ve/planet/img/logo.png" />
	<meta property="og:locale" content="es_VE" />
	<meta property="og:image:width" content="350" />
	<meta property="og:image:height" content="350" />
	<meta name="twitter:title" content="Xanadu GNU/Linux - Descarga">
	<meta name="twitter: description" content="Planeta VaSlibre, los principales FEEDS de sitios GNU Linux, Distribuciones"/> 
	<meta name="twitter: url" content="http://vaslibre.org.ve/planet/" />
	<meta name="twitter:imagen" content="http://vaslibre.org.ve/planet/img/logo.png" />
	<meta name="abstract" content="Xanadu Linux- Descarga" />
    <link rel="shortcut icon" href="img/favicon.png">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://vaslibre.org.ve/backend.php" />
	<link type="text/plain" rel="socialmedia" href="socialmedia.txt" />
    <link rel="canonical" href="http://vaslibre.org.ve/planet/" />
';
return;
}

function LEER_DIR()
{   $hay = 0;
	if ($gestor = opendir('descarga')) {
		while (false !== ($archivo = readdir($gestor))) {
		    if ($archivo != "." && $archivo != ".." && $archivo != 'index.html') {
                $hay = 1; 
                echo "» <a href=\"descarga.php?archivo=$archivo\" class=\"btn\" title=\"Descargar ISO: $archivo\"  target=\"popup\" onclick=\"window.open(this.href, this.target, 'width=10,height=10'); return false;\"><span>$archivo</span></a><br />";
		    }
		}
		closedir($gestor);
	}
    if ($hay == 0)
     { echo '<div class="alert alert-danger" role="alert">No hay ninguna <strong>.ISO</strong> que descargar</div>';}

	 return;
}
 

function LIMPIAR_VALORES()
{ $_SERVER['QUERY_STRING'] = trim(strip_tags($_SERVER['QUERY_STRING']));
  URL();
  if (!empty($_GET)){ 
  foreach($_GET as $variable=>$valor){
     $_GET[$variable] = $_GET[$variable];
     $_GET[$variable] = str_replace("'","\'",$_GET[$variable]);
     $_GET[$variable] = DECODE($_GET[$variable]);
     $_GET[$variable] = filter_var(trim($_GET[$variable]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
  }}
  if (!empty($_POST) ){
  foreach($_POST as $variable=>$valor){
     $_POST[$variable] = $_POST[$variable];
     $_POST[$variable] = str_replace("'","\'",$_POST[$variable]);
     $_POST[$variable] = DECODE($_POST[$variable]);
     $_POST[$variable] = filter_var(trim($_POST[$variable]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
  }}
return;
}

function REDES($tiwtter, $facebook, $youtube, $glus)
{ echo '<ul class="navbar-nav redes">';
  if (!empty($tiwtter)) 
   { echo '<li>
            <a href="https://twitter.com/'.$tiwtter.'" title="Siguenos en Twitter" target="_blank"><i><img src="img/social/twitter.png" alt="Twitter" width="48" height="48" /></i>
            </a></li>'; }
  if (!empty($facebook) )
   { echo '<li>
            <a href="https://facebook.com/groups/'.$facebook.'" title="Siguenos en Facebook" target="_blank"><i><img src="img/social/facebook.png" alt="Facebook" width="48" height="48" /></i></a></li>'; }

  if (!empty($glus)) 
   { echo '<li>
             <a href="https://plus.google.com/'.$gplus.'" title="Siguenos en G+" target="_blank"><i><img src="img/social/google.png" alt="G+" width="48" height="48" /></i></a></li>'; }
 
 if (!empty($youtube)) 
   { echo '<li><a href="https://youtube.com/channel/'.$youtube.'" title="Siguenos en Canal Youtube"><i><img src="img/social/youtube.png" alt="Youtube" width="48" height="48" /></i></a></li>'; }

 echo '  <li>
             <a href="http://vaslibre.org.ve/backend.php" title="Esta al tanto de nuestras notas" target="_blank"><i><img src="img/social/rss.png" width="48" height="48" alt="RSS/XML" /></i></a></li>';

 echo '</ul>';
return;
}

function RSS($url,$imagen)
{ global $entries;
if (VERIFICA_ONLINE($url)){
	$noticias = simplexml_load_file($url);
	$largo=700; 
	$lee=3;
	$ciclo = 1;
	foreach ($noticias as $noticia) {  
		foreach($noticia as $reg){ 
			if(!empty($reg->title) && $ciclo<$lee&& !empty($reg->description)){
		        $pubdate =  $reg->pubDate;
		        $title   =  $reg->title;
	 			$link    =  $reg->link;
		        $description =  strip_tags(substr($reg->description,0,$largo)).'...';
		        $timestamp   =  strtotime(substr($reg->pubDate,0,25));
		        $entries[$timestamp]['pubdate'] = $timestamp;
		        $entries[$timestamp]['title']   = $title;
		        $entries[$timestamp]['link']    = $link;
		        $entries[$timestamp]['image']   = $imagen;
		        $entries[$timestamp]['description'] = $description;
		        $ciclo++;    
			} 
		}
	}
}
return $entries;
}

function URL() { 
  if (empty($_SERVER["HTTP_REFERER"])) { $_SERVER["HTTP_REFERER"] = '';}
  $valor = strip_tags($_SERVER["HTTP_REFERER"]);
  $replace = "%20"; 
  $search = array(">", "<", "|", ";", "-","'",'"'); 
  $_SERVER["HTTP_REFERER"] = str_replace($search, $replace, $valor); 
return; 
}

function VERIFICA_CACHE($urlcache,$timecache,$expira)
{ ob_start("compress_page");
  if (file_exists($urlcache) && $expira < filemtime($urlcache)) {
     include $urlcache;#
     exit;
    }
return;
}

function VERIFICA_ONLINE($url)
{  	@$headers = get_headers($url);
    if (stristr ($headers[0],'200 OK'))
       {  return true; }
	else { return false; }
}
?>
