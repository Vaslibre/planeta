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

$ExpStr = ENCABEZADO();
LIMPIAR_VALORES();
$buffer = BUFFER_INICIO();
VERIFICA_CACHE($urlcache,$timecache,$expira);

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
   $contenido = trim(COMPRESS_PAGE(ob_get_contents()));
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

function getCleanParselyPageValue($val) {
    $val = str_replace("\n", "", $val);
    $val = str_replace("\r", "", $val);
 return $val;
}

function GoogleAnalytics($UA, $dominio)
{ echo "
  <script>
   (function(i,s,o,g,r,a,m)
    {i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   ga('create', '$UA', '$dominio');
   ga('require', 'displayfeatures');
   ga('send', 'pageview');
  </script>";
return;
}

function HCARD($latitud,$longitud,$nombre_sitio,$urlplanet,$ciudad,$provincia,$pais) {
echo '<div id="hcard-Xanadu Linux" class="vcard"> 
	   <span class="fn n"><span class="given-name">'.$nombre_sitio.'</span> 
	   </span>
           <div class="org">'.$nombre_sitio.'</div> 
	   <div class="adr">
             <span class="locality">'.$ciudad.'</span>,
             <span class="region">'.$provincia.'</span>, 
	         <span class="country-name">'.$pais.'</span>,
             <span class="postal-code">'.$postal.'</span> 
       </div> 
       <div class="url"><a href="'.$urlplanet.'" title="'.$nombre_sitio.'">'.$urlplanet.'</a></div>
	   <div class="geo">GEO: 
	    <span class="latitude">'.$latitud.'</span>, 
	    <span class="longitude">'.$longitud.'</span>
	   </div>
      </div>';
return;
}

function META($nombre_sitio,$descripcion,$latitud,$longitud,$urlplanet,$ExpStr,$glus,$activar,$twitter,$wot,$bing,$yahoo,$google,$alexa,$lenguaje,$theme)
{ echo '
    <meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9, IE=8, IE=7, chrome=1, IE=edge" />
    <meta name="owner" content="VaSlibre" />
	<meta name="resource-type" content="document" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="VaSlibre" />
	<meta name="revisit-after" content="1 days" />
	<meta name="revisit" content="1" />
	<meta name="distribution" content="Global" />
	<meta name="generator" content="Aptana" />
	<meta name="rating" content="General" />
	<meta name="country" content="Venezuela" />
	<meta name="language" content="'.$lenguaje.'" />
	<meta name="adblock" content="disable" />
	<meta name="advertising" content="ask" />
	<meta name="dc.title" content="'.$nombre_sitio.'" />
	<meta name="dc.date" content="'.date("Y-m-d",$_SERVER['REQUEST_TIME']).'" />
	<meta name="dc.format" content="text/html" />
	<meta name="dc.language" content="'.$lenguaje.'" />
	<meta name="geo.region" content="VE-G" />
	<meta name="geo.placename" content="Valencia" />
	<meta name="geo.position" content="'.$latitud.';'.$longitud.'" />
	<meta name="icbm" content="'.$latitud.';'.$longitud.'" />
	<meta name="keywords" content="Planeta,VaSlibre,RSS,Feed,Agregador,Xanadu,Xanadu Linux,sinfallas,xombra,viserproject,gnu,linux,keyword,keyword,WOT_keyword" />
	<meta name="description" content="'.$descripcion.'" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/" />
	<meta name="medium" content="mult" />
    <meta name="twitter:creator" content="@'.$twitter.'"/>
	<meta name="twitter:title" content="'.$nombre_sitio.'">
	<meta name="twitter: description" content="'.$nombre_sitio.'"/> 
	<meta name="twitter: url" content="'.$urlplanet.'" />
	<meta name="twitter:imagen" content="'.$urlplanet.'themes/'.$theme.'/img/logo.png" />
	<meta name="abstract" content="'.$nombre_sitio.'" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta http-equiv="pragma" content="cache" />
	<meta http-equiv="cache-control" content ="cache" />
	<meta http-equiv="vary" content="content-language" />
    <meta http-equiv="expires" content="'.$ExpStr.'" />
    <meta http-equiv="imagetoolbar" content="no" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="'.$nombre_sitio.'" />
	<meta property="og:description" content="'.$descripcion.'" />
	<meta property="og:url" content="'.$urlplanet.'" />
	<meta property="og:site_name" content="'.$nombre_sitio.'" />
	<meta property="og:image" content="'.$urlplanet.'themes/'.$theme.'/img/logo.png" />
	<meta property="og:locale" content="es_VE" />
	<meta property="og:image:width" content="350" />
	<meta property="og:image:height" content="350" />
    <link rel="apple-touch-icon" href="themes/'.$theme.'/img/apple.png" />
    <link rel="shortcut icon" href="themes/'.$theme.'/img/favicon.png">
	<link rel="icon" href="themes/'.$theme.'/img/favicon.png" type="image/x-icon" />
	<link rel="shortcut icon" href="themes/'.$theme.'/img/favicon.png" type="image/x-icon" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$urlplanet.'backend.xml" />
    <link rel="canonical" href="'.$urlplanet.'" />
	<link rel="socialmedia" type="text/plain" href="'.$urlplanet.'socialmedia.txt" rel="socialmedia" />
    <link rel="me" href="https://plus.google.com/'.$glus.'/about" />';
  $parselyPage = array();
  $parselyPage["title"]     = $nombre_sitio;
  $parselyPage["link"]      = $urlplanet;
  $parselyPage["image_url"] = $urlplanet.'/themes/'.$theme.'/img/logo.png';
  $parselyPage["type"]      = "post";
  $parselyPage["post_id"]   = $post_id;  
  $parselyPage["pub_date"]  = gmdate("M d Y H:i:s",time());
  $parselyPage["author"]    = getCleanParselyPageValue($nombre_sitio);
  $output = '<meta name="parsely-page" content="'.json_encode($parselyPage,JSON_HEX_APOS | JSON_HEX_QUOT).'" />';
if ($activar == 1) { 
	echo '
    <meta name="wot-verification" content="'.$wot.'" />
    <meta name="msvalidate.01" content="'.$bing.'" /> 
	<meta name="y_key" content="'.$yahoo.'" /> 
    <meta name="google-site-verification" content="'.$google.'" />
	<meta name="alexaVerifyID" content="'.$alexa.'" />';
	}
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

function  REDES($twitter, $facebook, $youtube, $glus, $theme)
{ 
 echo '<ul class="navbar-nav redes">';
  if (!empty($twitter)) 
   { echo '<li>
            <a href="https://twitter.com/'.$twitter.'" title="Siguenos en Twitter" target="_blank"><i><img src="themes/'.$theme.'/img/social/twitter.png" alt="Twitter" width="48" height="48" /></i>
            </a></li>'; }
  if (!empty($facebook) )
   { echo '<li>
            <a href="https://facebook.com/groups/'.$facebook.'" title="Siguenos en Facebook" target="_blank"><i><img src="themes/'.$theme.'/img/social/facebook.png" alt="Facebook" width="48" height="48" /></i></a></li>'; }
  if (!empty($glus)) 
   { echo '<li>
             <a href="https://plus.google.com/'.$glus.'" title="Siguenos en G+" target="_blank"><i><img src="themes/'.$theme.'/img/social/google.png" alt="G+" width="48" height="48" /></i></a></li>'; }
 if (!empty($youtube)) 
   { echo '<li><a href="https://youtube.com/channel/'.$youtube.'" title="Siguenos en Canal Youtube"><i><img src="themes/'.$theme.'/img/social/youtube.png" alt="Youtube" width="48" height="48" /></i></a></li>'; }
 echo '  <li><a href="backend.xml" title="Esta al tanto de nuestras notas" target="_blank"><i><img src="themes/'.$theme.'/img/social/rss.png" width="48" height="48" alt="RSS/XML" /></i></a></li>';
 echo '</ul>';
return;
}

function RSS($url,$imagen,$leer_cant_feed,$largo_lectura)
{ global $entries;
if (VERIFICA_ONLINE($url)){
	$noticias = simplexml_load_file($url);
	$lee=$leer_cant_feed;
	$ciclo = 1;
    $largo = $largo_lectura;
	foreach ($noticias as $noticia) {  
		foreach($noticia as $reg){ 
			if(!empty($reg->title) && $ciclo<$lee&& !empty($reg->description) && !empty($reg->pubDate)){
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
{ @$headers = get_headers($url);
  if (stristr ($headers[0],'200 OK'))
   { return true; }
  else { return false; }
}
?>
