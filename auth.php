<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "functions/functions.php";
    $title = "Регистрация";
    require_once "blocks/head.php";
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>
    <div id="wrapper">
        <div id="leftCol">
        	<form action="validation_form/auth.php" method="post">
            	<input type="text" name="login" id="login" placeholder="Введите логин"><br />
            	<input type="password" name="pass" id="pass" placeholder="Введите пароль"><br />
            	<input type="submit" name="done" id="done" value="Авторизоваться">
            </form>
        </div>
        <?php require_once "blocks/rightCol.php" ?>
    </div>
    <?php require_once "blocks/footer.php" ?>
</body>

</html>