<?php 
$fecha = date("Y-m-d",time());
$contenido = '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
    <url>
      <loc>'.$urlplanet.'</loc>
      <lastmod>'.$fecha.'</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.9</priority>
    </url> 
</urlset>';
$gestor = fopen('sitemap.xml', 'w+');
fwrite($gestor, trim($contenido));
fclose($gestor);
?>
