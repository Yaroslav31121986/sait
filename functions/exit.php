<?php
//открываем сессию
session_start();

session_destroy();
 //удаляем кукиииии...!!!
// setcookie( 'user', $user['name'], time() - 60, "/");
// //Отправляем заголовки и возвращяемся на index.html

header ("Location:/sait_1/");
exit();
?>