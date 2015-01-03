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
include 'include/config.php';
include 'include/core.php';
$expira = time() - $timecache;
VERIFICA_CACHE($urlcache,$timecache,$expira);
?>
<!DOCTYPE html>
<html lang="es_VE">
<head>
<link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css' />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<?php
 echo '<title>'.$nombre_sitio.'</title>';
 META(); 
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<noscript>
<p>Debe habilitar el uso de Javascript, para poder usar muchas de las funciones del sitio</p>
</noscript>
<?php flush(); ?>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <header>
        <nav class="navbar navbar-default navbar-static-top barra_nav" role="navigation">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="enlace"> <a id="modal-452838" href="#modal-container-452838" role="button" class="btn" data-toggle="modal">Agregar tu RSS</a> </div>
            <div>
              <?php REDES($twitter, $facebook, $youtube, $glus); ?>
            </div>
          </div>
        </nav>
      </header>
      <section>
        <div class="row clearfix">
          <div class="col-md-12 column">
            <h1 class="text-primary text-center"><?php echo $nombre_sitio;?></h1>
          </div>
        </div>
        <?php 
				foreach ($feeds as $imagen => $url) 
                 {  RSS($url,$imagen);  }
                    krsort($entries); 
                foreach ($entries as $timestamp => $entry) {
		            echo '
                   <div class="row clearfix abre">
		            <article class="format-standard">
						<div class="col-md-2 column">
							<img alt="'.$imagen.'" src="img/avatar/'.$entry['image'].'.png" class="img-circle img-responsive img_blog">
						</div>
						<div class="col-md-10 column">
							 <div class="caja"> 
							      <div class="cajatitulo">
                                       <span class="fecha_post">Fecha:'.date("d/m/Y",$entry['pubdate']).' </span>
									   <h2><a href="'.$entry['link'].'" target="_blank" title="Leer nota en: '.$entry['title'].'">'.$entry['title'].'</a></h2>
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
                   </div>
		          '; 
                } ?>
      </section>
      <footer>
        <div class="row clearfix">
          <div class="col-md-12 column">
            <hr />
            <div style="float:right;"> Licencia de uso:<br />
              <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" title="Bajo Licencia Creative Commons"><img alt="Licencia de Creative Commons" style="border-width:0;" width="88" height="31" src="img/88x31.png" /></a><br />
            </div>
            <div class="div_footer">
              <p>Grupo de Usuarios de VaSlibre<br />
                Valencia - Carabobo - Venezuela<br />
                &copy; 2014 - <?php echo date("Y",time()); ?> Dise&ntilde;o & Programaci&oacute;n: [ <a href="http://viserproject.com" target="_blank" title="Visitar ViserProject"><span>ViSerProject</span></a> ]<br />
               Código fuente: <a href="https://github.com/Vaslibre/planeta" target="_blank" title="Código Fuente del Planeta"><span>github.com</span></a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="modal fade" id="modal-container-452838" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel"> Agregar tu Blog - FEED/RSS </h4>
        </div>
        <div class="modal-body">
          <div id="myWatch"></div>
          <form enctype="application/x-www-form-urlencoded" class="form-horizontal" action="javascript:void(0);" role="form" method="post" name="form1" id="form1" onsubmit="return GetUser(); return document.MM_returnValue">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tu eMail</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="eMail">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">URL Feed</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="url" placeholder="https | https -> Url Feed">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Agregar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="contcookies" style="display: none;">Este sitio, como la mayoría, usa cookies. Si sigues navegando entendemos que aceptas las Políticas de cookies.
    <a href="#" class="cookiesaceptar">Aceptar</a>
  </div>
  <script type="text/javascript" src="js/js.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</div>
<?php HCARD(); ?>
</body>
</html>
<?php 
 BUFFER_FIN();
 if (!file_exists($urlcache) || $expira < filemtime($urlcache))
  {  CREA_CACHE($urlcache,$timecache,$buffer,$expira);  }
 BORRAR_VARIABLES();
 ?>
