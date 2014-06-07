<?php
 
	include_once("class.phpmailer.php");
	include_once("class.smtp.php");
	 
	//Especificamos los datos y configuración del servidor
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = false;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	 
	//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
	$mail->Username = "jarozco92@gmail.com";
	$mail->Password = "password";
	 
	//Agregamos la información que el correo requiere
	$mail->From = "jarozco92@gmail.com";
	$mail->FromName = "Jesus";
	$mail->Subject = "Enviar Mail con PHPMailer";
	$mail->AltBody = "";
	$mail->MsgHTML("<h1>Hola Mundo!</h1>");
	$mail->AddAttachment("adjunto.txt");
	$mail->AddAddress("destinatario@hotmail.com", "Usuario Prueba");
	$mail->IsHTML(true);
	 
	//Enviamos el correo electrónico
	$mail->Send();
?>