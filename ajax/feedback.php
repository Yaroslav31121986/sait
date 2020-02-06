<?php 
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$subject = htmlspecialchars($_POST['subject']);
	$massege = htmlspecialchars($_POST['massege']);
	if ($name == '' || $email == '' || $subject == '' || $massege == '')  {
		echo "Заполните все поля";
		exit;
	}
	//Отправка
	$subject = "=?utf-8?B?".base64_encode($subject)."?=";
	$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";
	if (mail("vlasjaro3@gmail.com", $subject, $massege, $headers)){
		echo "Сообщение отправлено";
	} else {
		echo "Сообщение не отправлено";
	}
 ?>