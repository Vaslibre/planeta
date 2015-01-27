<?php
header('Content-Type: text/xml');
header("Content-Type: application/rss+xml"); 
include 'include/config.php';
function convertir($cadena) 
{  $cadena= stripslashes($cadena); 
   $buscar = array('<br>', '<p>', '</p>', '<br />','&nbsp;','@','"');
   $reemplazar = array(' ');
   $cadena = str_replace($buscar, $reemplazar, $cadena);
   $buscar = array('á', 'é', 'í', 'ó','ú');
   $reemplazar = array('a', 'e', 'i', 'o','u');
   $cadena = str_replace($buscar, $reemplazar, $cadena);
   $buscar = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;');
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
foreach ($feeds as $imagen => $url)
{RSS($url,$imagen,$leer_cant_feed,$largo_lectura);}
$urlplanet = substr($urlplanet,0,strlen($urlplanet)-1);
$ahora = time();
$fecha = date("r",$ahora);
$year  = date("Y",$ahora);
$icon  = $urlplanet.'/themes/'.$theme.'/img/rss.png';
$xml = '';
$xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n\r"; 
$xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n\r";
$xml .= "<channel>\n\r
  <title>$nombre_sitio</title>\r
  <subtitle>$descripcion</subtitle>\r
  <link>$urlplanet</link>\r
  <description>$descripcion</description>\r
  <language>$lenguaje</language>\r
  <copyright>Copyleft 2014 $year, $nombre_sitio</copyright>\r
  <pubDate>$fecha</pubDate>\r
  <lastBuildDate>$fecha</lastBuildDate>\n\r
  <docs>$urlplanet</docs>\n\r
  <generator>Script ViSeRProject http://viserproject.com</generator>n\r
  <webMaster>$emailinfo ($nombre_sitio)</webMaster>\r
  <managingEditor>$emailinfo ($nombre_sitio)</managingEditor>\r
  <image>\r
  <title>$nombre_sitio</title>\r
  <url>$icon</url>\r
  <link>$urlplanet</link>\r
  <description>$descripcion</description>\r
  </image>\r
  <ttl>600</ttl>\n\r";
foreach ($entries as $timestamp => $entry) {
$urltitle = urlencode($entry['title']);
$fecha    = date("r",$entry['pubdate']);
$entry['title'] = trim(strip_tags($entry['title']));
$entry['description'] = trim(strip_tags($entry['description']));
$xml .= "\n\r<item>\r
<title>$entry[title]</title>\r
<link>$urlplanet/index.php?r=$entry[link]|$urltitle</link>\r
<guid>$urlplanet/index.php?r=$entry[link]|$urltitle</guid>\r
<pubDate>$fecha</pubDate>\r
<description>\r
<![CDATA[<img src=\"$urlplanet/img/avatar/$entry[image].png\" alt=\"$entry[image]\" align=\"left\" style=\"float:left; width:95px; height:95px; margin-right:13px; margin-bottom:12px;\">$entry[description]]]></description>\r
</item>\r\n";
}
$xml .= "</channel>\n\r
</rss>\n\r";
$xml = trim($xml);
$filexml = fopen('backend.xml', 'w+');
fwrite($filexml, $xml);
fclose($filexml);
include 'backend.xml';  
?>
