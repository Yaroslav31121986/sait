<?php
require_once "connect.php";

// функция выводить количество статей
function countPages () {
	global $mysqli;
	connectDB ();
	$result =  $mysqli->query("SELECT COUNT(id) FROM news");

	if (!$result) {
			die("Fatal Error");
		} 
		else {
			closeDB ();
			$countPages = $result->fetch_assoc();
			$count = $countPages["COUNT(id)"];
			return $count;
		}
}
//функция вывода статей
function getNews ($limit, $id) {

	global $mysqli;
	connectDB ();
	if ($id){

		$result =  $mysqli->query("SELECT * FROM news WHERE id = $id");
		
		if (!$result) {
			die("Fatal Error");
		} 
		else {
			closeDB ();
			return $result->fetch_assoc();
		}
	} 
	else {
		// в переменную $max указываем какое колтчество статей будем выводить
		$max = 3;
		$result = $mysqli->query("SELECT * FROM news ORDER BY id DESC LIMIT $limit,$max");

		if (!$result) {
		die("Fatal Error");
		} 

		else{
			closeDB ();
			return resultToArray ($result);
		}
	}	
}

// функция выводит комментарии к статье
function commentsDb ($id){ 
	global $mysqli;
	connectDB ();	
	if ($id){

		$result =  $mysqli->query("SELECT comments.comment, comments.datte, users.name FROM comments LEFT JOIN users ON comments.login = users.login WHERE comments.id_news = $id");
		
		if (!$result) {
			die("Fatal Error");
		} 
		else {
			closeDB ();
			return resultToArray ($result);
		}
	} 
}

function resultToArray ($result) {
	$array = array();
	while (($row = $result->fetch_assoc()) != false) {
		$array[] = $row;
	}
		return $array;
}
?>
