<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // проверяем пустая ли переменная р если да то присваеваем ей 0
    $numberPage = $currentPage = isset($_GET["p"]) ? (int) $_GET["p"] : 0;
    $p = isset($_GET["p"]) ? (int) $_GET["p"] : 0;
    // умножаем количество нужных выведеных статей на номер страницы
    $p = $p*3;
    require_once "functions/functions.php";
    $title = "Новости обо всем";
    require_once "blocks/head.php";
    // вызываем функцию для вывода статей, и параметр с какой статьи мы выводим
    $news = getNews ($p, NULL);
    // вызываем функцию которая возвращяет количество статей в БД
    $countPages = countPages ();
    // делим количество статей в БД на то количество которое нужно вывести
    $allPages = floor( $countPages / 3);
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>
    <div id="wrapper">
        <div id="leftCol">
            
            <?php

            for ($i = 0; $i < count($news); $i++ ) 
            {
                if ($i == 0)
                {
                echo  "<div id=\"bigArticle\">";
                }
                else
                {
                    // выводим главную статью
                    echo "<div class=\"article\">";
                }   
                // выводим остальные статьи
                    echo '<img src="img/article/'.$news[$i]["id"].'.jpg" alt="article'.$news[$i]["id"].'" title="article'.$news[$i]["id"].'">
                    <h2>'.$news[$i]["title"].'</h2><br>
                    <p>'.$news[$i]["intro_text"].'</p>
                    <a href="article.php?id='.$news[$i]["id"].'">
                    <div class="more">Далее</div>
                    </a>
                    </div>';
            
                if ($i == 0) 
                    {
                    echo   '<div class="clear"><br></div>';
                    }
            }
            ?>
            <div class="container">
                  <!-- выводим нумерации страниц -->
                <? 
                if ($numberPage == 0){
                	$maxPage = $numberPage + 2;
                } elseif ($numberPage == $allPages) {
               		$maxPage = $allPages;
               		$numberPage = $numberPage - 2;
                } else {
                	$maxPage = $numberPage + 1;
               		$numberPage = $numberPage - 1;
                }
                for($numberPage; $numberPage <= $maxPage; $numberPage++){ ?>
                	<?php if ($numberPage == $currentPage) { ?>
								<span class="currentpage"><a href="?p=<?= $numberPage ?>"><?= $numberPage + 1 ?></a></span>
						<?php }else {?>
							<span class="pages"><a href="?p=<?= $numberPage ?>"><?= $numberPage + 1 ?></a></span>	
                	<? } ?>	
                <? } ?>
                 
            </div> 

        </div>
        <?php require_once "blocks/rightCol.php" ?>
    </div>
    <?php require_once "blocks/footer.php" ?>
</body>

</html>
