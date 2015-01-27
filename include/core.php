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
$ExpStr= ENCABEZADO();
LIMPIAR_VALORES();
$buffer= BUFFER_INICIO();
global $palabras;
$GLOBALS['palabras']= array(
		  ' a ',' ah ',' al ',' alla ',' alo ',' ano ',' ante ',' anti ',' am ',' aquel ',' aquellos ',' aquellas ',
          ' atras ',' ay ',' ahora ',' are ',' anos ',' ano ',' aqui ',' antes ',
		  ' b ',' bajo',' bien',' bueno ',
		  ' cada',' casi ',' con ',' contra ',' coma ',' comer ',' como ',' cómo ',' cambiar ',' cuyo ',' .com ',' com ',
		  ' da ',' dando ',' de ' , ' del',' dejar ',' desde ',' di ',' dia ',' dice ',' donde ',' dijo ',' día ',
		  ' e ',' el ',' ella ',' ellas ',' ello ',' ellos ',' en ' ,' entonces ',' entre ',' era ',' eran ',' es ', 
          ' esa ',' ese ',' esas ',' eso ',' esos ',' esta ',' estan ',' estas ',' esto ',' estos ',' está ',' eramos ',
		  ' fue ',' fueron ',' fuese ',' fuesen ',' fui ',' fuimos ','full ',' for ',
          ' gran ',' grande ','gracias ',
	      ' ha ',' halla ',' hallar ',' hasta ',' haya ',' hayan ',' hayamos ',' hayaron ',' hubo ',
          ' hablemos ',' hablar ',' hacer ',' hacen ',
          ' i ',' iban ',' idem ',' ido ',' in ',' ir ',' irian ',' item ',' is ',
          ' ja ',' jamas ',' je ',' ji ',' jo ',' juntos ',
		  ' kill ',
	  	  ' la ',' las ',' lanza ',' le ',' les ',' lo ',' los ',
		  ' mas ',  ' matar ',' me ',' mes ',' mejor ',' mi ',' mias ',' mios ',' mis ',' mucho ',
		  ' nada ',' nadie ',' ni ',' ninguno ',' no ',' nos ',' nosotros ',' numero ',' numeros ',
	 	  ' o ',' ok ',' on ',' otras ',' otros ','of',
		  ' para ',' paran ',' parte ',' peor ',' pm ',' por ',' poco ',' podran ',' pondra ',' pondran ',' porque ',
          ' puede ',' pero ',' puedo ',' pueden ',' puedes ',' pudo ',' punto ',
		  ' que ',' quien ',' quienes ',' quiere ',' quieren ',' quiero ',' quisiera ',' quisieran ',' quisieras ',' quiso ',
		  ' se ',' sera ',' si ',' sin ',' sobre ',' solo ',' sólo ',' su ',' sus ', ' ser ', 
		  ' t ',' tambien ',' te ',' tenia ',' the ',' tiene ',' tienen ',' to ',' toda ',' todas ',' tras ',' tu ',
          ' tus ',' tuyas ',' tuyos ',' tuvo ',
	 	  ' u ',  ' un ',' una ',' unas ',' uno ',' unos ',
		  ' v ',' vamos ',' van ',' viene ',' vienen ',' ver ',' viste ',' vosotros ',' vive ',' voy ',' vuelve ',' va ', 
		  ' y ',' ya ', ' yo ',
		  '/','#','&','(',')','.',',',';',':','-','*','{','}','[',']','<','>','$','%','=','@','?','!','"','+','¿',
           '|','“','...','¡',' - ','–','”','“','€',
		  '1','2','3','4','5','6','7','8','9','0');

function BORRAR_VARIABLES()
{ $_GET= $_POST= array(); 
  unset($_POST,$_GET);
return;
}

function BUFFER_INICIO()
{ $buffer= trim(ob_start("COMPRESS_PAGE"));
  return $buffer;
}

function BUFFER_FIN()
{ trim(ob_flush());
  BORRAR_VARIABLES();
 return;
}

function COOKIES()
{ echo '
<div class="contcookies" style="display:none;">Este sitio, como la mayoría, usa cookies. Si sigues navegando entendemos que acepta las politicas de uso. <a href="#" class="cookiesaceptar">Aceptar</a></div>';
return;
}

function COMPRESS_PAGE($buffer) 
{ $search = $replace= array(); 
  $search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
  $replace= array(">","<",'\\1');
  $buffer = preg_replace($search, $replace, $buffer);
  $buffer = str_replace('> <','><',$buffer);
  return trim($buffer);
}

function CREA_CACHE($urlcache,$buffer)
{  ob_end_flush();
   $filecached= fopen($urlcache, 'w+');
   $contenido = trim(COMPRESS_PAGE(ob_get_contents()));
   fwrite($filecached, $contenido);
   fclose($filecached);  
return;
}

function CREAR_TOKEN($TokenForm) 
{ $token= md5(uniqid(microtime(), true));
  $token_time= time();
  $_SESSION['csrf'][$TokenForm.'_token']= array('token'=>$token, 'time'=>$token_time); 
return $token;
}

function DECODE($origen) {
 $origen= html_entity_decode($origen, ENT_QUOTES, "UTF-8");
 $origen= htmlspecialchars($origen, ENT_QUOTES, "UTF-8");
return $origen;
}

function ENCABEZADO(){
  global $ExpStr;
  header('Accept-Ranges: bytes');
  $tiempo=  $_SERVER['REQUEST_TIME'] + 7200;
  $ExpStr= 'Expires: '.gmdate("D, d M Y H:i:s", $tiempo) . " GMT"; 
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
  $etag= md5($_SERVER['REQUEST_URI'] . $ExpStr);
  header("Etag: $etag");
return $ExpStr;
}

function getCleanParselyPageValue($val) {
    $val= str_replace("\n", "", $val);
    $val= str_replace("\r", "", $val);
 return trim($val);
}

function GoogleAnalytics($UA)
{ 
echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create','$UA','auto'); ga('send','pageview');</script>";
return;
}

function GPLUS()
{ echo "<g:plusone annotation=\"inline\"></g:plusone>
<script type=\"text/javascript\">window.___gcfg= {lang: 'es-419'};
   (function() {var po= document.createElement('script'); po.type= 'text/javascript'; po.async= true;
	po.src= 'https://apis.google.com/js/plusone.js';
	var s= document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
";
}

function HCARD($latitud,$longitud,$nombre_sitio,$urlplanet,$ciudad,$provincia,$pais) {
echo '<div id="hcard-'.$nombre_sitio.'" class="vcard">
	   <span class="fn n"><span class="given-name">'.$nombre_sitio.'</span></span>
           <div class="org">'.$nombre_sitio.'</div>
	   <div class="adr">
          <span class="locality">'.$ciudad.'</span>,<span class="region">'.$provincia.'</span>,<span class="country-name">'.$pais.'</span>,<span class="postal-code">'.$postal.'</span>
       </div>
       <div class="url"><a href="'.$urlplanet.'" title="'.$nombre_sitio.'">'.$urlplanet.'</a></div>
	   <div class="geo">GEO:<span class="latitude">'.$latitud.'</span>,<span class="longitude">'.$longitud.'</span>
	   </div></div>';
return;
}

function LIMPIAR_VALORES()
{ $_SERVER['QUERY_STRING']= trim(strip_tags($_SERVER['QUERY_STRING']));
  URL();
  if (!empty($_GET)){ 
  foreach($_GET as $variable=>$valor){
     $_GET[$variable]= $_GET[$variable];
     $_GET[$variable]= str_replace("'","\'",$_GET[$variable]);
     $_GET[$variable]= DECODE($_GET[$variable]);
     $_GET[$variable]= filter_var(trim($_GET[$variable]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
  }}
  if (!empty($_POST) ){
  foreach($_POST as $variable=>$valor){
     $_POST[$variable]= $_POST[$variable];
     $_POST[$variable]= str_replace("'","\'",$_POST[$variable]);
     $_POST[$variable]= DECODE($_POST[$variable]);
     $_POST[$variable]= filter_var(trim($_POST[$variable]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
  }}
return;
}

function META($nombre_sitio,$descripcion,$latitud,$longitud,$urlplanet,$ExpStr,$glus,$activar,$twitter,$wot,$bing,$yahoo,$google,$alexa,$lenguaje,$theme)
{ echo '<meta charset="utf-8">
    <meta name="HandheldFriendly" content="True">
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="pragma" content="cache">
	<meta http-equiv="cache-control" content="cache">
	<meta http-equiv="vary" content="content-language">
    <meta http-equiv="expires" content="'.$ExpStr.'">
    <meta http-equiv="imagetoolbar" content="no">
	<meta name="robots" content="index,follow">
	<meta name="author" content="VaSlibre">
	<meta name="revisit-after" content="1 days">
	<meta name="revisit" content="1">
	<meta name="distribution" content="Global">
	<meta name="generator" content="Aptana">
	<meta name="rating" content="General">
	<meta name="country" content="Venezuela">
	<meta name="language" content="'.$lenguaje.'">
	<meta name="adblock" content="disable">
	<meta name="advertising" content="ask">
	<meta name="dc.title" content="'.$nombre_sitio.'">
	<meta name="dc.date" content="'.date("Y-m-d",$_SERVER['REQUEST_TIME']).'">
	<meta name="dc.format" content="text/html">
	<meta name="dc.language" content="'.$lenguaje.'">
	<meta name="geo.region" content="VE-G">
	<meta name="geo.placename" content="Valencia">
	<meta name="geo.position" content="'.$latitud.';'.$longitud.'">
	<meta name="icbm" content="'.$latitud.';'.$longitud.'">
	<meta name="keywords" content="Planeta,VaSlibre,RSS,Feed,Agregador,Xanadu,Xanadu,Linux,sinfallas,xombra,viserproject,gnu,linux,keyword,keyword,WOT_keyword,planet,tux,rss,xml,opml,fedora,ubuntu,debian,gentoo,arch,venenux,canaima,mint,kali,Android">
	<meta name="description" content="'.$descripcion.'">
	<meta name="viewport" content="initial-scale= 1.0">
	<meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/">
	<meta name="medium" content="mult">
	<meta name="abstract" content="'.$nombre_sitio.'">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="'.$twitter.'" />
    <meta name="twitter:creator" content="@'.$twitter.'">
	<meta name="twitter:title" content="'.$nombre_sitio.'">
	<meta name="twitter:description" content="'.$nombre_sitio.'">
	<meta name="twitter:url" content="'.$urlplanet.'">
	<meta name="twitter:image" content="'.$urlplanet.'img/logo.png">
	<meta name="twitter:image:src" content="'.$urlplanet.'img/logo.png">
    <meta property="og:type" content="article"/>
	<meta property="og:title" content="'.$nombre_sitio.'">
	<meta property="og:description" content="'.$descripcion.'">
	<meta property="og:url" content="'.$urlplanet.'">
	<meta property="og:site_name" content="'.$nombre_sitio.'">
	<meta property="og:image" content="'.$urlplanet.'img/logo.png">
	<meta property="og:locale" content="es_VE">
	<meta property="og:image:width" content="295">
	<meta property="og:image:height" content="295">
    <link rel="apple-touch-icon" href="img/apple.png">
    <link rel="shortcut icon" href="img/favicon.png">
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$urlplanet.'backend.xml">
    <link rel="canonical" href="'.$urlplanet.'">
	<link rel="socialmedia" href="'.$urlplanet.'socialmedia.txt" rel="socialmedia">
    <link rel="me" href="https://plus.google.com/'.$glus.'/about">
    <link rel="publisher" href="https://plus.google.com/'.$glus.'">';
  $parselyPage= array();
  $parselyPage["title"]    = $nombre_sitio;
  $parselyPage["link"]     = $urlplanet;
  $parselyPage["image_url"]= $urlplanet.'img/logo.png';
  $parselyPage["type"]     ="post";
  $parselyPage["post_id"]  = $post_id;  
  $parselyPage["pub_date"] = gmdate("M d Y H:i:s",time());
  $parselyPage["author"]   = getCleanParselyPageValue($nombre_sitio);
  $output= '<meta name="parsely-page" content="'.json_encode($parselyPage,JSON_HEX_APOS | JSON_HEX_QUOT).'">';
if ($activar== 1) { 
	echo '
    <meta name="wot-verification" content="'.$wot.'">
    <meta name="msvalidate.01" content="'.$bing.'">
	<meta name="y_key" content="'.$yahoo.'">
    <meta name="google-site-verification" content="'.$google.'">
	<meta name="alexaVerifyID" content="'.$alexa.'">';
	}
return;
}

function METAREDIRECCION($nombre_sitio,$descripcion,$latitud,$longitud,$urlplanet,$ExpStr,$glus,$twitter,$lenguaje,$urlsitio,$title,$theme,$enlace)
{ $titleurl= $title;
  $title= str_replace('-',' ',$title);
 echo '<meta charset="utf-8">
    <title>'.$nombre_sitio.' | '.$title.'</title>
    <meta name="HandheldFriendly" content="True">
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="vary" content="content-language">
    <meta http-equiv="imagetoolbar" content="no">
	<meta name="robots" content="index,follow">
	<meta name="author" content="VaSlibre">
	<meta name="revisit-after" content="1 days">
	<meta name="revisit" content="1">
	<meta name="distribution" content="Global">
	<meta name="generator" content="Aptana">
	<meta name="rating" content="General">
	<meta name="country" content="Venezuela">
	<meta name="language" content="'.$lenguaje.'">
	<meta name="adblock" content="disable">
	<meta name="advertising" content="ask">
	<meta name="dc.title" content="'.$nombre_sitio.'">
	<meta name="dc.date" content="'.date("Y-m-d",$_SERVER['REQUEST_TIME']).'">
	<meta name="dc.format" content="text/html">
	<meta name="dc.language" content="'.$lenguaje.'">
	<meta name="geo.region" content="VE-G">
	<meta name="geo.placename" content="Valencia">
	<meta name="geo.position" content="'.$latitud.';'.$longitud.'">
	<meta name="icbm" content="'.$latitud.';'.$longitud.'">
	<meta name="keywords" content="Planeta,VaSlibre,RSS,Feed,Agregador,Xanadu,Xanadu,Linux,sinfallas,xombra,viserproject,gnu,linux,keyword,keyword,WOT_keyword,planet,tux,rss,xml,opml,fedora,ubuntu,debian,gentoo,arch,venenux,canaima,mint,kali,Android">
	<meta name="description" content="'.$descripcion.' - '.$title.'">
	<meta name="viewport" content="initial-scale= 1.0">
	<meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/">
	<meta name="medium" content="mult">
	<meta name="abstract" content="'.$nombre_sitio.'">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="'.$twitter.'" />
    <meta name="twitter:creator" content="@'.$twitter.'">
	<meta name="twitter:image" content="'.$urlplanet.'img/logo.png">
	<meta name="twitter:image:src" content="'.$urlplanet.'img/logo.png">
	<meta name="twitter:title" content="'.$nombre_sitio.' | '.$title.'">
	<meta name="twitter:description" content="'.$nombre_sitio.' | '.$title.'">
	<meta name="twitter:url" content="'.$enlace.'">
	<meta property="og:title" content="'.$nombre_sitio.' | '.$title.'">
	<meta property="og:description" content="'.$nombre_sitio.' | '.$title.'">
	<meta property="og:url" content="'.$enlace.'">
	<meta property="og:site_name" content="'.$nombre_sitio.'">
	<meta property="og:image" content="'.$urlplanet.'img/logo.png">
    <meta property="og:image" content="'.$urlplanet.'themes/'.$theme.'/images/planeta-vaslibre.png">
    <meta property="og:image" content="'.$urlplanet.'themes/'.$theme.'/images/logovaslibre2.png">
	<meta property="og:locale" content="es_VE">
    <meta property="og:image:width" content="295">
	<meta property="og:image:height" content="295">
    <meta property="og:type" content="article"/>
    <link rel="apple-touch-icon" href="img/apple.png">
    <link rel="shortcut icon" href="img/favicon.png">
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$urlplanet.'backend.xml">
    <link rel="canonical" href="'.$urlplanet.'index.php?r='.$urlsitio.'|'.$titleurl.'">
	<link rel="socialmedia" href="'.$urlplanet.'socialmedia.txt" rel="socialmedia">
    <link rel="me" href="https://plus.google.com/'.$glus.'/about">
    <link rel="publisher" href="https://plus.google.com/'.$glus.'">';
  $parselyPage= array();
  $parselyPage["title"]    = trim($nombre_sitio.' | '.$title);
  $parselyPage["link"]     = $enlace;
  $parselyPage["image_url"]= $urlplanet.'/themes/'.$theme.'/img/logo.png';
  $parselyPage["type"]     ="post";
  $parselyPage["post_id"]  = $post_id;  
  $parselyPage["pub_date"] = gmdate("M d Y H:i:s",time());
  $parselyPage["author"]   = getCleanParselyPageValue($nombre_sitio);
  $output= '<meta name="parsely-page" content="'.json_encode($parselyPage,JSON_HEX_APOS | JSON_HEX_QUOT).'">';
return;
}

function NUBE_TAGS($tags)
{ 	$busqueda= $GLOBALS['palabras'];
    $tags .= 'ubuntu linux fedora planeta planet abraxas xombra blog web internet gentoo debian mint gnu sabayon libreoffice thunderbird firefox';
	$search = array('Á','É','Í','Ó','Ú','á','é','í','ó','ú','Ü','ü','Ñ','ñ','&');
	$replace= array('a','e','i','o','u','a','e','i','o','u','u','u','n','n',' ');
	$tags= trim(strtolower($tags));
	$html= array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;');
	$str = array('a','e','i','o','u','u','u','n');
	$tags= str_replace($html, $str, $tags);
	$tags= str_replace($search, $replace, $tags);
	$tags= str_replace($busqueda,' ',$tags);
	$tags= preg_replace('/\s\s+/',' ', $tags );
	$tags= str_replace($busqueda,' ',$tags);
	$temp= explode(' ',$tags);
	$tags= array();
	$result= array_unique($temp);
	$rnd= count($result);
	$rand_keys= array_rand($result, $rnd);
    echo '<ul class="list-inline">';
	for ($i=0;$i<=$rnd;$i++)
	 { $tags[$i]= $result[$rand_keys[$i]]; }
	for ($i=0;$i<$rnd;$i++)
	{    srand((double)microtime()*1000000); 
	     $ft= rand(1,5);
	     switch($ft){
		  case '1': echo '<li><p class="btn btn-primary btn-xs abre" role="button">'; break;
		  case '2': echo '<li><p class="btn btn-success btn-xs abre" role="button">'; break;
		  case '3': echo '<li><p class="btn btn-warning btn-xs abre" role="button">'; break;
		  case '4': echo '<li><p class="btn btn-danger  btn-xs abre" role="button">'; break;
          case '5': echo '<li><p class="btn btn-info  btn-xs abre" role="button">';   break;     
		 }
		echo $tags[$i].'</p></li>';	 
	}
        echo '</ul>';
return;
} 

function OPML()
{ include 'openml.php';
return;
}

function PUBLICIDAD($publicidad)
{foreach ($publicidad as $imagen=> $enlace) {
   $img[] = $imagen;
   $link[]= $enlace;
  }
   $hay = count($img)-1;
   $rand= mt_rand(0,$hay);
 echo '<a href="'.$link[$rand].'" target="_blank" title="Visitar:'.$link[$rand].'"><img src="img/publicidad/'.$img[$rand].'.png" class="img-responsive img-center" alt="banner '.$img[$rand].'"/></a>';
return;
}

function  REDES($twitter, $facebook, $youtube, $glus, $principal, $theme)
{ echo '<ul class="navbar-nav redes">';
  if (!empty($principal)) 
   { echo '<li>
            <a href="http://'.$principal.'" title="Visita nuestro Blog" target="_blank"><i><img src="themes/'.$theme.'/img/social/blog.png" alt="Blog" width="48" height="48"/></i>
            </a></li>'; }
  if (!empty($twitter)) 
   { echo '<li>
            <a href="https://twitter.com/'.$twitter.'" title="Siguenos en Twitter" target="_blank"><i><img src="themes/'.$theme.'/img/social/twitter.png" alt="Twitter" width="48" height="48"/></i>
            </a></li>'; }
  if (!empty($facebook) )
   { echo '<li>
            <a href="https://facebook.com/groups/'.$facebook.'" title="Siguenos en Facebook" target="_blank"><i><img src="themes/'.$theme.'/img/social/facebook.png" alt="Facebook" width="48" height="48/></i></a></li>'; }
  if (!empty($glus)) 
   { echo '<li>
             <a href="https://plus.google.com/'.$glus.'" title="Siguenos en G+" target="_blank"><i><img src="themes/'.$theme.'/img/social/google.png" alt="G+" width="48" height="48"/></i></a></li>'; }
 if (!empty($youtube)) 
   { echo '<li><a href="https://youtube.com/channel/'.$youtube.'" title="Siguenos en Canal Youtube"><i><img src="themes/'.$theme.'/img/social/youtube.png" alt="Youtube" width="48" height="48"/></i></a></li>'; }
 echo '  <li><a href="backend.xml" title="Esta al tanto de nuestras notas" target="_blank"><i><img src="themes/'.$theme.'/img/social/rss.png" width="48" height="48" alt="RSS/XML"/></i></a></li>';
 echo '</ul>';
return;
}

function RSS($url,$imagen,$leer_cant_feed,$largo_lectura,$timenota)
{ global $entries;
if (VERIFICA_ONLINE($url)){
	$noticias= simplexml_load_file($url);
	$lee= $leer_cant_feed;
    $ahora = time();
	$ciclo= 1;
    $largo= $largo_lectura;
	foreach ($noticias as $noticia) {  
		foreach($noticia as $reg){ 
			if(!empty($reg->title) && $ciclo<$lee&& !empty($reg->description) && !empty($reg->pubDate)){
		        $pubdate = $reg->pubDate;
                $timestamp  =  strtotime(substr($reg->pubDate,0,25));
                $dif =  $ahora - $timestamp;
                if ($dif <= $timenota) {
                 $title  =  trim(strip_tags($reg->title));
	 			$link   =  $reg->link;
		        $description=  strip_tags(substr($reg->description,0,$largo)).'...';
		        $entries[$timestamp]['pubdate']= $timestamp;
		        $entries[$timestamp]['title']  = $title;
		        $entries[$timestamp]['link']   = $link;
		        $entries[$timestamp]['image']  = $imagen;
		        $entries[$timestamp]['description']= $description;
		        $ciclo++;
              }    
			} 
		}
	}
}
return $entries;
}

function RSS_MOSTRAR($url,$imagen,$leer_cant_feed,$largo_lectura,$feeds,$theme,$timenota)
{  $tags= '';
  echo '<div class="feed">';
           foreach ($feeds as $imagen=> $url) 
             { $entries = RSS($url,$imagen,$leer_cant_feed,$largo_lectura,$timenota);  }
           krsort($entries); 
           foreach ($entries as $timestamp=> $entry) {
            $entry['link']="index.php?r=".base64_encode("$entry[link]|$entry[title]");
            echo '                   
              <div class="feed-item">
                 <article class="feed-content">
                   <div class="pull-left">
                      <a class="media-left" href="'.$entry['link'].'" target="_self" title="Leer nota: '.$entry['title'].'">
            <img alt="'.$entry['image'].'" src="img/avatar/'.$entry['image'].'.png" class="img-responsive img-circle avatar">
                      </a>
                   </div>
                   <h2><a href="'.$entry['link'].'" target="_self" title="Leer nota: '.$entry['title'].'">'.$entry['title'].'</a></h2>
                   <p>'.$entry['description'].'</p>
                   <hr/>
                   <ul class="list-inline list-unstyled">
                    <li><img src="themes/'.$theme.'/images/calendar.png" alt="calendar" title="calendar" class="calendar"/>&nbsp;'.date("d/m/Y",$entry['pubdate']).'</span></li>
                   </ul>
                  </article>
              </div>';
              $tags .= $entry['title'].' '; 
           }
 echo '</div>';
return $tags;
}
function RSS_IMG(){
echo'<h3>Agreganos a tu web</h3>
    <p>Agrega estos botones a tu web</p>
    <p><img src="img/planeta_vaslibre_80x15.png" class="img-responsive img-center" alt="Planeta Vaslibre RSS">
        <pre>
        &lt;img src="http://planeta.vaslibre.org.ve/img/planeta_vaslibre_80x15.png" alt="Planeta Vaslibre RSS" /&gt;
        </pre>     
    </p>
    <p>
       <img src="img/planeta_vaslibre_rss_200x200.png" class="img-responsive img-center" alt="Planeta Vaslibre RSS">
       <pre>
        &lt;img src="http://planeta.vaslibre.org.ve/img/planeta_vaslibre_rss_200x200.png" alt="Planeta Vaslibre RSS" /&gt;
       </pre>
    </p>
    <hr/>';
return;
}

function SUBSCRIPCIONES($feeds)
{echo '<ul>';
   foreach ($feeds as $imagen=> $enlace) {
   #$enlaceC= explode('/',$enlace);
   #$enlaceC= str_replace('www.','',$enlaceC[2]);
   echo '<li><a href="'.$enlace.'" target="_blank" title="Visitar:'.$imagen.'">'.$imagen.'</a></li>';
  }
 echo '</ul>';
return;
}

function URL() { 
  if (empty($_SERVER["HTTP_REFERER"])) { $_SERVER["HTTP_REFERER"]= '';}
  $valor= strip_tags($_SERVER["HTTP_REFERER"]);
  $replace="%20"; 
  $search= array(">", "<", "|", ";", "-","'",'"'); 
  $_SERVER["HTTP_REFERER"]= str_replace($search, $replace, $valor); 
return; 
}

function VERIFICA_CACHE($urlcache,$expira,$vidafile)
{ ob_start("COMPRESS_PAGE");
  if (file_exists($urlcache) && $vidafile>= $expira ) {
     include $urlcache; 
     die();
    }
return;
}

function VER_FEED($urlsitio,$urlplanet,$nombre_sitio,$title,$theme,$enlace)
{  #$enlace= $enlace;
   $title= urlencode(str_replace('%20',' ',$title));
   $title= str_replace('-',' ',$title);
   $title= str_replace('+',' ',$title);
   $urlcorta= explode('/',$urlsitio);
   $url=$urlplanet.'index.php?r='.$urlsitio.'|'.$title;
   $imagen=$urlplanet.'img/logo.png';
echo '
<div style="visibility:hidden; height:0px">
 <img src="'.$imagen.'" style="visibility:hidden"/>
</div>
<nav><img src="img/apple.png" alt="logo_small" style="float:left; margin-top:32px; z-index:99999"/>
    <ul class="list-inline">
      <li><strong>Regresar a: </strong><a href="'.$urlplanet.'" rel="'.$urlplanet.'" target="_self">'.$nombre_sitio.'</a></li>
      <li><strong>Ver desde sitio: </strong><a href="'.$urlsitio.'" target="_blank" rel="'.$urlsitio.'" title="ir al sitio '.$urlsitio.'">'.$urlcorta[2].'</a></li>
     <li>Compartir en:</li>
      <li>
       <a href="http://www.facebook.com/sharer.php?u='.$enlace.'" target="_blank" title="Compartir en facebook">
           <img src="img/icon/02_facebook.png" alt="Compartir en facebook" class="share"/>
        </a>
      </li>
      <li>
        <a href="http://twitter.com/?status='.$title.'%20via @vaslibre '.$enlace.'" target="_blank" title="Compartir en twiiter">
          <img src="img/icon/01_twitter.png" alt="Compartir en twitter" class="share"/>
        </a>
      </li>
      <li>
        <a href="https://plus.google.com/share?url='.$enlace.'" target="_blank" title="Compartir en G+">
          <img src="img/icon/14_google+.png" alt="Compartir en G+" class="share"/>
        </a>
      </li>
    </ul>
</nav>
<div class="marco">
    <iframe src="'.$urlsitio.'" frameborder="0" scrolling="yes" id="iframe"></iframe>
</div>';
return;
}

function VERIFICA_ONLINE($url)
{ @$headers= get_headers($url);
  if (stristr ($headers[0],'200 OK'))
   { return true; }
  else { return false; }
}

function VERIFICA_TOKEN($TokenForm, $token) 
{  if(!isset($_SESSION['csrf'][$TokenForm.'_token'])) {
       return false;
   }
   if ($_SESSION['csrf'][$TokenForm.'_token']['token'] !== $token) {
       return false;
   }
   return true;
}
?>
