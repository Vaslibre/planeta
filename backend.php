<?php
#header("Content-Type: application/rss+xml");
include 'include/config.php';
$expira = time() - $timecache;
if (file_exists('backend.xml') && $expira < filemtime($urlcache)) {
include 'backend.xml';
exit;
}
function convertir($cadena) 
{$cadena= stripslashes($cadena); 
 $buscar = array('<br>', '<p>', '</p>', '<br />','<br>','&nbsp;','@','"','&iexcl;','&gt;','#160',
 '<','>','&lt;','&amp;','&','¿','#8211;','#8221;','#8220;','#8230;','#8594;','&quot;','&apos;',"'",'[]');
 $reemplazar = '';
 $cadena = str_replace($buscar, $reemplazar, $cadena);
 $buscar = array('á', 'é', 'í', 'ó','ú','ñ');
 $reemplazar = array('a', 'e', 'i', 'o','u','n');
 $cadena = str_replace($buscar, $reemplazar, $cadena);
 $buscar = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;','&ntilde;');
 $cadena_arreglada = str_replace($buscar, $reemplazar, $cadena);
 return ($cadena_arreglada);
}
function RSS($url,$imagen,$leer_cant_feed,$largo_lectura)
{ global $entries;
$noticias = simplexml_load_file($url);
$largo=$largo_lectura; 
$lee=$leer_cant_feed;
$ciclo = 1;
foreach ($noticias as $noticia) {
foreach($noticia as $reg){ 
if(!empty($reg->title) && $ciclo<$lee&& !empty($reg->description) && !empty($reg->pubDate)){
$pubdate = $reg->pubDate;
$title = trim(utf8_decode(convertir(strip_tags($reg->title))));
$link = $reg->link;
$description = trim(utf8_decode(convertir(substr(strip_tags($reg->description),0,$largo)))).'...';
$timestamp = strtotime(substr($reg->pubDate,0,25));
$entries[$timestamp]['pubdate'] = $timestamp;
$entries[$timestamp]['title']   = $title;
$entries[$timestamp]['link']    = $link;
$entries[$timestamp]['image']   = $imagen;
$entries[$timestamp]['description'] = $description;
$ciclo++;
}}}
krsort($entries);
return $entries;
}
$xml = '';
$urlplanet = substr($urlplanet,0,strlen($urlplanet)-1);
$ahora = time();
$fecha = date("r",$ahora);
$year  = date("Y",$ahora);
$icon  = $urlplanet.'/themes/'.$theme.'/img/rss.png';
$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
<feed xmlns="http://www.w3.org/2005/Atom">';
$xml .= "\r\n<channel>\r
<title>$nombre_sitio</title>\r
<link>$urlplanet</link>\r
<description>$descripcion</description>\r
<language>$lang</language>\r
<copyright>Copyleft 2014 -$year, $nombre_sitio</copyright>\r
<pubDate>$fecha</pubDate>\r
<lastBuildDate>$fecha</lastBuildDate>\r
<docs>$urlplanet</docs>\r
<generator>Script ViSeRProject http://viserproject.com</generator>\r
<webMaster>$emailinfo ($nombre_sitio)</webMaster>\r
<managingEditor>$emailinfo (($nombre_sitio)</managingEditor>\r
<image>\r
<title>$nombre_sitio</title>\r
<url>$icon</url>\r
<link>$urlplanet</link>\r
<description>$descripcion</description>\r
</image>\r
<ttl>120</ttl>\r\n";
foreach ($feeds as $imagen => $url)
{RSS($url,$imagen,$leer_cant_feed,$largo_lectura);}
foreach ($entries as $timestamp => $entry) {
$fecha = date("r",$entry['pubdate']);
$entry['title'] = $entry['title'];
$entry['description'] = $entry['description'];
$xml .= "\n\r<entry>\r
<title>$entry[title]</title>\r
<link>$entry[link]</link>\r
<guid>$entry[link]</guid>\r
<pubDate>$fecha</pubDate>\r
<description>\r
<![CDATA[<img src=\"$urlplanet/img/avatar/$entry[image].png\" alt=\"$entry[image]\" align=\"left\" style=\"float:left; width:95px; height:95px;\">$entry[description]]]></description>\r
</entry>\r\n";
}
$xml .= "</channel></feed>\n\r";
$xml = trim($xml);
$filexml = fopen('backend.xml', 'w+');
fwrite($filexml, $xml);
fclose($filexml);
include 'backend.xml';
?>
