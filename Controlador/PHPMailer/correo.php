
<?php
// multiple recipients

require_once('PHPMailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Port = 465;
$mail->CharSet = "UTF-8";
$mail->SMTPSecure = "ssl";
$mail->Username = "proyeccionescolarjj@gmail.com";
$mail->Password = "cuentautil";
$mail->SMTPDebug = 0;
$mail->Debugoutput ="html";

$mail->From ="proyeccionescolarjj@gmail.com";
$mail->FromName = "Pepito PE";
$mail->AddAddress("jrorozco92@yahoo.com.mx", "Javier");//First a email, then a name
$mail->Subject = "Ejemplo de PHPMailer";
$mail->Body = "<p> Esto es un <strong> ejemplo </strong> de correo. </p";
$mail->AltBody = "Esto es un ejemplo de correo.";
$mial->IsHTML = (true);

if($mail->Send()){
	echo "Mensaje enviado correctamente. ";

}else{
	echo "Ocurrio un error al enviar el correo electronico. ";
	echo "</br> <strong> Informacion: </strong><br/>".$mail->ErrorInfo;

}

    
?>
