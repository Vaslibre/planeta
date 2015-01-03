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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->      
<?php
 echo '<title>'.$nombre_sitio.'</title>';
 META(); 
?>


  </head>
  <body>
<noscript>
<p>Debe habilitar el uso de Javascript, para poder usar muchas de las funciones del sitio</p>
</noscript>
<?php flush(); ?>      
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="">  
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>           
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="intro-message">
                    <h1>Planeta</h1>
                    <h3>VaSLibre</h3>
                </div>
            </div>
        </div>
    </div>
</div>      
<div class="container page">
        <?php 
				foreach ($feeds as $imagen => $url) 
                 {  RSS($url,$imagen);  }
                    krsort($entries); 
                foreach ($entries as $timestamp => $entry) {
		            echo '
  <div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" alt="'.$imagen.'" src="img/avatar/'.$entry['image'].'.png" class="img-responsive">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">'.$entry['title'].'</h4>
            <p>'.$entry['description'].'</p>
            <p><a href="'.$entry['link'].'" target="_blank" title="Leer nota en: '.$entry['title'].'">Leer m&aacute;s</a></p>
          <ul class="list-inline list-unstyled">
  			<li><span><i class="glyphicon glyphicon-calendar"></i> '.date("d/m/Y",$entry['pubdate']).' </span></li>
			</ul>
       </div>
    </div>
  </div>'; 
                } ?>


      
</div>   <!-- /container -->
    
<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">&copy; 2014 - <?php echo date("Y",time()); ?> Dise&ntilde;o & Programaci&oacute;n: [ <a href="http://viserproject.com" target="_blank" title="Visitar ViserProject"><span>ViSerProject</span></a> ]</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<?php HCARD(); ?>  
</body>
    
</html>    
<?php 
 BUFFER_FIN();
 if (!file_exists($urlcache) || $expira < filemtime($urlcache))
  {  CREA_CACHE($urlcache,$timecache,$buffer,$expira);  }
BORRAR_VARIABLES();
 ?>
