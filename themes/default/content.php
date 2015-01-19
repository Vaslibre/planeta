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
echo '
<div class="col-md-12 column">
  <h1 class="text-primary text-center">'.$nombre_sitio.'</h1>
</div>
<div class="col-md-12 column">
	<div style="margin-top:-40px">';
	$tags = RSS_MOSTRAR($url,$imagen,$leer_cant_feed,$largo_lectura,$feeds,$theme,$timenota); 
echo '
    </div>
</div>';
?>
