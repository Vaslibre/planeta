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
	   foreach ($feeds as $imagen => $url) 
	     { RSS($url,$imagen,$leer_cant_feed,$largo_lectura);  }
	   krsort($entries); 
	   foreach ($entries as $timestamp => $entry) {
		   echo '
	         <div class="row clearfix abre">

		        <article>

					<div class="col-md-2 column">
						<img alt="'.$entry['image'].'" src="img/avatar/'.$entry['image'].'.png" width="95" height="95" class="img-circle img-responsive img_blog" />
					</div>
					<div class="col-md-10 column">

	 				   <div class="caja">

						 <div class="cajatitulo">
		                    <span class="fecha_post">Fecha:'.date("d/m/Y",$entry['pubdate']).'</span>
						    <h2><a href="'.$entry['link'].'" target="_blank" title="Leer nota: '.$entry['title'].'">'.$entry['title'].'</a></h2>
						 <div>

		                 <div class="cajacontenido">
	 		                '.$entry['description'].'
		                     <div class="bottomd">&nbsp;</div>
		                 </div>

					   </div>

		            </div>

		            <div class="bottomd">&nbsp;</div>

		       </article>

		       <div class="bottomd">&nbsp;</div>

		    </div>'; 
		} 
echo '
    </div>
</div>';
?>
