<?php
if(isset($_POST['mensaje'])) {

  $email_to = "darkfenix0021@gmail.com"; 
  $email_subject = $_POST['asunto'];

  function died($error) {
    echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
    echo "Detalle de los errores.<br /><br />";
    echo $error."<br /><br />";
    echo "Porfavor corrija estos errores e inténtelo de nuevo.<br /><br />";
    die();
  }

  if(!isset($_POST['asunto']) ||
     !isset($_POST['correo']) ||
     !isset($_POST['mensaje'])) {

    die('Lo sentimos pero parece haber un problema con los datos enviados.');
}


$asunto = $_POST['asunto'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];
$error_message = "";


$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if(!preg_match($email_exp,$correo)) {
  $error_message .= 'El correo no es válido. <br />';
}


$string_exp = "/^[A-Za-z .'-]+$/";

if(!preg_match($string_exp,$mensaje)) {
  $error_message .= 'El mensaje no es válido. <br />';
}

if(strlen($error_message) > 0) {
  die($error_message);
}


$email_message = "Contenido del Mensaje:\n\n";

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_message .= "Mensaje: ".clean_string($mensaje)."\n";

 
$headers = 'From: '.$correo."\r\n".'Reply-To: '.$correo."\r\n" .'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);
?>

Gracias!
 
<?php
 
}
 
?>