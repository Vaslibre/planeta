<?php
header('Content-Type: text/xml');
header("Content-Type: application/rss+xml"); 
include 'include/config.php';
$actualizacion = date("r",filemtime('include/config.php'));
$creado = date("r",'1421377082');
$xml = '';
$xml .= "
<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n
<opml version=\"2.0\">\r\n
<head>\r\n
<title>Feed List $nombre_sitio</title>\r
<ownerName>$nombre_sitio</ownerName>\r
<dateCreated>$creado GMT</dateCreated>\r
<dateModified>$actualizacion GMT</dateModified>\r
<ownerEmail>$emailinfo</ownerEmail>\r\r
</head>\r\n
<body>\r\n\r\n";
$urlplanet = substr($urlplanet,0,strlen($urlplanet)-1);
$xml .= "<outline text=\"$nombre_sitio\"  title=\"$nombre_sitio\">\r\n";
$xml .= "<outline text=\"$nombre_sitio\" title=\"$nombre_sitio\" type=\"rss\" xmlUrl=\"$urlplanet/backend.xml\"/>\r\n";
foreach ($feeds as $imagen => $enlace) {
   $xml .= "<outline text=\"$imagen\" title=\"$imagen\" type=\"rss\" xmlUrl=\"$enlace\"/>\r\n";
  }

$xml .= "</outline>
\r\n</body>\r\n
</opml>";
$xml = trim($xml);
$file = "opml-planeta.opml";
$filexml = fopen($file, 'w+');
fwrite($filexml, $xml);
fclose($filexml);
header("Content-Disposition: attachment; filename=" . urlencode($file));    
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");             
header("Content-Length: " . filesize($file));
flush();
$fp = fopen($file, "r"); 
while (!feof($fp))
{ echo fread($fp, 65536); 
  flush();
}  
fclose($fp); 
?>
