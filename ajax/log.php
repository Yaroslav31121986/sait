<?php
$login = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);

//подключаеися к базе данных
require_once "../functions/connect.php";
connectDB ();

//отправляем запрос
$result = $mysqli->query("SELECT login FROM users WHERE login = '$login'");
$result = $result->fetch_assoc();


if ( $result != NULL) {
	echo "К сожалению Логин: ".$login." уже занят";
} else {
	echo "Такой Логин: свободен";
}

//закрываем соединине с БД
closeDB ();
?>