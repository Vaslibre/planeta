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
	<nav class="navbar navbar-default navbar-static-top barra_nav" role="navigation">
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <div class="enlace"> <a id="modal-452838" href="#modal-container-452838" role="button" class="btn" data-toggle="modal">Agrega tu RSS|Feed</a></div>
		     <div class="cajaLOGO">
		       <a href="index.php" title="'.$nombre_sitio.'" class="logo" style="margin-top:-50px;"><img width="95" height="95" src="themes/'.$theme.'/img/logo.png" class="img-responsive" alt="Logo"></a></div>  
			 <div>';
			   REDES($twitter, $facebook, $youtube, $glus, $principal, $theme);
	echo '</div>
	  </div>
	</nav>
</div>
';
?>
