<?php
//открываем сессию
session_start();
$login = $_SESSION['login'];
$id = (int) $id = $_SESSION['id'];
//соединяемся с БД
require_once "../functions/connect.php";
connectDB ();

//удаляем пробелы и теги
$comment = filter_var(trim($_POST['comment']), FILTER_SANITIZE_STRING);
$t = time();

//создаемм массив который потом поместим JSON 
$arr = array('login' => $login);

//отправляе запрос в базу данных
$result = $mysqli->query("INSERT INTO comments (login,comment,datte,id_news) VALUES ('$login', '$comment', '$t', '$id')");

if (!$result) {
			die("Fatal Error");
		} 
		else {		
			closeDB ();
			//Отправляем JSON
			echo json_encode($arr);
			// exit();
		}
?>