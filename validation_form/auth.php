<?php
//делаем соединение с базой данной
require_once "../functions/connect.php";
connectDB ();

//удаляем пробелы и теги со значений которые ввел пользователь в форме
// $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
// $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);


$login = mysql_entities_fix_string($mysqli, $_POST['login']);
$pass = mysql_entities_fix_string($mysqli, $_POST['pass']);


// // Хешируе пароль и посыпаем солью
$salt1 = "qm&h*";
$salt2 = "pg!@";
$pass = hash('ripemd128', "$salt1$pass$salt2");

//отправляе запрос в базу данных
$result = $mysqli->query("SELECT * FROM users WHERE login = '$login' AND pass = '$pass'");


// //помещяем данные в асоцыативный массив
$user = $result->fetch_assoc();

// //делаем проверку есть ли такой пользаватель
if(count($user) == 0){
	echo "Такого пользавателя нету ";
	echo "<p><a href='/sait_1/auth.php'>Назад</a></p>";
	exit();
}

// //закрываем соединение с базой данной
closeDB ();

// //передаем кукиииии...!!!
// // setcookie( 'user', $user['name'], time() + 60, "/");

//вызываем сессию и передаем значение $login сессиии
session_start();
$_SESSION['login'] = $login;

// // echo $_SESSION['login'];

// //фунции по удалению пробеллов и тегов

function mysql_entities_fix_string($mysqli, $string)
{
return htmlentities(mysql_fix_string($mysqli, $string));
}
function mysql_fix_string($mysqli, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $mysqli->real_escape_string($string);
}

// //Отправляем заголовки и возвращяемся на index.html
header ("Location:/sait_1/");
exit();
?>
