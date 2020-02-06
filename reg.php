<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "functions/functions.php";
    $title = "Регистрация";
    require_once "blocks/head.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready (function () {
            $("#login").blur (function () {
                $('#massegeShow').hide();
                var login = $("#login").val ();

                if (login != "") {
                     $.ajax ({
                                url: 'ajax/log.php',
                                type: 'POST',
                                cache: false,
                                data: {'login': login},
                                dataType: 'html',
                                success: function (data){
                                    $('#massegeShow').html (data + "<div class='clear'><br /></div>");
                                    $('#massegeShow').show ();
                         }
                    }); 
                }  
            });
            //проверка на правильность введеных данных
            $("#done").click (function () {
                $('#massegeShow').hide();
                var name = $("#name").val ();
                var email = $("#email").val ();
                var login = $("#login").val ();
                var pass = $("#pass").val ();
                var fail = "";

                if (name.length < 2 ) {
                    fail = "Имя не меньше 3 символов";
                } 
                else if (email.split ('@').length - 1 == 0 || email.split ('.').length - 1 == 0) {
                    fail = "Вы ввели не корректный email";
                }
                else if (login.length < 2) {
                    fail = "Логин не меньше 2 символов";
                }
                else if (pass.length < 8) {
                    fail = "Пароль не менее 8 символов";
                }
                if (fail != "") {
                    $('#massegeShow').html (fail + "<div class='clear><br></div>'");
                    $('#massegeShow').show ();
                
                } else {
                $.ajax ({
                    url: 'validation_form/check.php',
                    type: 'POST',
                    cache: false,
                    data: {'name': name, 'email': email, 'login': login, 'pass': pass},
                    dataType: 'html',
                    success: function (data){
                            var url = "http://localhost/sait_1/";
                            $(location).attr('href',url);
                    }
                }); 
                }
            });
        });
    </script>
</head>

<body>
    <?php require_once "blocks/header.php" ?>
    <div id="wrapper">
        <div id="leftCol">
        		<input type="text" placeholder="Введите Имя" id="name" name="name"> <br />
            	<input type="text" placeholder="Введите Email" id="email" name="email"> <br />
            	<input type="text" name="login" id="login" placeholder="Введите логин"><br />
            	<input type="password" name="pass" id="pass" placeholder="Введите пароль"><br />
                <div id="massegeShow"></div>
            	<input type="submit" name="done" id="done" value="Зарегистрировать">
        </div>
        <?php require_once "blocks/rightCol.php" ?>
    </div>
    <?php require_once "blocks/footer.php" ?>
</body>
</html>