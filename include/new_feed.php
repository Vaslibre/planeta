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
# Envio de nuevo Feed para su revision
session_start();
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
   header("location:../error.html");
   die();
}

include 'config.php';
include 'core.php';

$token = $_POST['auth_token'];
if(!VERIFICA_TOKEN('SeP', $token)){
   echo '<div class="alert alert-danger"><p>'.$token.' expiro, <br /> Refresque e intente de nuevo</p></div>';
   die();
}
$email    = filter_var(strip_tags(trim(strtolower($_POST['inputEmail']))),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
$urlfeed  = strip_tags(strtolower(trim($_POST['url'])));
$ahora     = date("d-m-Y H:i"),time());
$localidad = $_SERVER['REMOTE_ADDR'];
$envio = 0;

$asunto  = "Nuevo FEED enviado a $dominio";
$contacto = $contacto.','.$emailinfo;
$mensaje ="Saludos: <br>
             Hemos recibido desde [ $email  ] una nueva direccion feed(xml<br>
             Feed recibido:<br>
             $urlfeed<br><br>
             Enviado desde IP: $localidad<br>
             Hora: $ahora<br><br>
             $dominio<br>";

$headers = '';  
$headers .= "MIME-Version:1.0\r\n"; 
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
$headers .= "Received:from www.$dominio\r\n";
$headers .= "X-Priority:3\r\n";
$headers .= "X-MSMail-Priority:Normal\r\n";
$headers .= "From:<$email>\r\n";
$headers .= "X-Mailer:$email\r\n"; 
$headers .= "Return-path:$email\r\n";
$headers .= "Reply-To:$email\r\n";
$headers .= "X-Antiabuse:Enviar notificacion a $emailinfo\r\n";

if (@mail($contacto,$asunto,$mensaje,$headers))
 {  $envio = 1;   
    $headers = '';  
	$headers .= "MIME-Version:1.0\r\n"; 
	$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	$headers .= "Received:from www.$dominio\r\n";
	$headers .= "X-Priority:3\r\n";
	$headers .= "X-MSMail-Priority:Normal\r\n";
	$headers .= "From:<$emailinfo>\r\n";
	$headers .= "X-Mailer:$emailinfo\r\n"; 
	$headers .= "Return-path:$emailinfo\r\n";
	$headers .= "Reply-To:$emailinfo\r\n";
	$headers .= "X-Antiabuse:Enviar notificacion a $emailinfo\r\n";
	if (@mail($email,"Re: $asunto",$mensaje,$headers))
       {  $envio = 1;  } 
    else {  $envio = 0; }
 }
if ($envio == 1)
 {  echo '
    <div class="well text-center bg-succes btn-success" role="success">
     <p class=" btn-success">Hemos recibido su enlace feed, en las próximas horas lo contactaremos.</p>
    </div>';
 }
else
 { echo '
   <div class ="well text-center alert alert-danger" role="alert">
     <p>ERROR! inesperado, no se pudo enviar el email. Intente más tarde o contacte al administrador del sitio</p>
   </div>
  ';
 }
unset($header,$email);
$_POST = array();
?>
