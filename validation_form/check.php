<?php
//удаляем пробелы и теги со значений которые ввел пользователь в форме
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

//проверяем повторно правильность введенных данных в форме
if (mb_strlen($login) < 2 || mb_strlen($login) > 90){
	echo "Недопустимая длина Логина";
	exit();
} elseif (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
	echo "Недопустимая длина Имени";
	exit();
} elseif (mb_strlen($pass) < 8 || mb_strlen($pass) > 50) {
	echo "Недопустимая длина пароля (от 3 до 50 символов)";
	exit();
} elseif (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email)) {
	echo "Неверно указан email";
	exit();
}

// Хешируе пароль и посыпаем солью
$salt1 = "qm&h*";
$salt2 = "pg!@";
$pass = hash('ripemd128', "$salt1$pass$salt2");

//делаем соединение с базой данной
require_once "../functions/connect.php";
connectDB ();

//отправляе запрос в базу данных
$mysqli->query("INSERT INTO users (login, pass, name, email) VALUES ('$login', '$pass', '$name', '$email')");

//закрываем соединение с базой данной
closeDB ();

//открываем сессию
session_start();
$_SESSION['login'] = $login;

?>
