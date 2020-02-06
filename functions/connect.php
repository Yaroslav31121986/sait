<?php
$mysqli = false;
function connectDB () {
    global $mysqli;
    require "login.php";
    $mysqli = new mysqli ( $hn, $un, $pw, $db);
	if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}
  $result = $mysqli->query("SET NAMES 'utr-8'");
}

function closeDB () {
    global $mysqli;
    $mysqli->close ();
}
?>