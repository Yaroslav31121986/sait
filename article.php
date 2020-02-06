<?php
    //открываем сессию 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    //передаем сессии id статьи 
    $_SESSION['id'] = $_GET["id"];

    //подключаем файл отвечающий за подключение к БД и вывод статей
    require_once "functions/functions.php";

    //вызываем функцию которая достает нам комментарии к статье с БД, передаем ей параметр id статьи,
    //результат передаем переменной $comment
    $comment = commentsDb ($_GET["id"]);

    //вызываем функцию которая достает нужную нам статью с БД, передаем ей параметр id статьи,
    //результат передаем переменной $news
    $news = getNews (1, $_GET["id"]);

    //в title передаем название статьи
    $title = $news["title"];

    //подключаем стили и выводим название статьи в title
    require "blocks/head.php";   
    ?>
    <!-- подключаем jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- подключаем скрипт отвечающий за отправку комментариев на сервер и одновреммено вывод их на страничку AJAX -->
    <script src="js/comments.js"></script>
</head>
<body>
    <!-- подключае файл отвечающий за вывод шапки  -->
    <?php require_once "blocks/header.php";?>
    <div id="wrapper">
        <div id="leftCol">
            <div id="bigArticle">
            <?php
                // выводим саму статью
                echo '<img src="img/article/'.$news["id"].'.jpg" alt="article'.$news["id"].'" title="article'.$news["id"].'">
                <h2>'.$news["title"].'</h2><br>
                <p>'.$news["full_text"].'</p><br>'
            ?>
            <?php    
                date_default_timezone_set('Europe/Kiev');//устанавливаю часовой пояс

                // проверяем есть ли коментарии если да то выводим
                if (count($comment) != 0) {
                    echo "<div id = 'comments'>";
                    for ($i = 0; $i < count($comment); $i++ ){
                        echo "<div class = 'comment'>"."<h3>".$comment[$i]["name"]."</h3><p>".$comment[$i]["comment"]."</p><span>".date('Y-m-d', $comment[$i]["datte"])."</span></div>";

                    }
                    echo "</div>";
                }
                // проверяем авторизовался ли посетитель если да то выводим форму для комментариев
                if ($login){
                            echo'<div id="comm"><p>Комментарий</p></div><p>
                                <textarea name="comment" id="comment" cols="40" rows="3">
                                </textarea></p>
                                <div id="massegeShow"></div>
                                <p><input type="submit" name="butt" id="butt" value="Отправить"></p>
                                ';
                }
            ?>

            </div>
            <div class="clear"><br></div>
        </div>
        <!-- подключаем правую колонку -->
        <?php require_once "blocks/rightCol.php" ?>
    </div>
    <!-- подключаем футер -->
    <?php require_once "blocks/footer.php" ?>
</body>

</html>
