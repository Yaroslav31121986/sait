<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Обратнаяя связь";
    require_once "blocks/head.php"; 
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready (function () {
            $("#done").click (function () {
                $('#massegeShow').hide();
                var name = $("#name").val ();
                var email = $("#email").val ();
                var subject = $("#subject").val ();
                var massege = $("#massege").val ();
                var fail = "";

                if (name.length < 3 ) {
                    fail = "Имя не меньше 3 символов";
                } 
                else if (email.split ('@').length - 1 == 0 || email.split ('.').length - 1 == 0) {
                    fail = "Вы ввели не корректный email";
                }
                else if (subject.length < 5) {
                    fail = "Тема сообщения мения 5 символов";
                }
                else if (massege.length < 20) {
                    fail = "Сообщение не менее 20 символов";
                }
                if (fail != "") {
                    $('#massegeShow').html (fail + "<div class='clear><br></div>'");
                    $('#massegeShow').show ();
                
                } else {
                $.ajax ({
                    url: 'ajax/feedback.php',
                    type: 'POST',
                    cache: false,
                    data: {'name': name, 'email': email, 'subject': subject, 'massege': massege},
                    dataType: 'html',
                    success: function (data){
                       $('#massegeShow').html (data + "<div class='clear'><br /></div>");
                       $('#massegeShow').show ();
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
            <input type="text" placeholder="Имя" id="name" name="name"> <br />
            <input type="text" placeholder="Email" id="email" name="email"> <br />
            <input type="text" placeholder="Тема сообщения" id="subject" name="subject"> <br />
            <textarea name="massege" id="massege" placeholder="Введите сюда ваше сообщения"></textarea><br />
            <div id="massegeShow"></div>
            <input type="button" name="done" id="done" value="Отправить">
        </div>
        <?php require_once "blocks/rightCol.php" ?>
    </div>
    <?php require_once "blocks/footer.php" ?>
</body>

</html>
