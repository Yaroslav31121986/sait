<header>
    <div id="logo">
        <a href="http://localhost/sait_1/" title="Перейти на главную страницу"><span>Н</span>овости</a>
    </div>
    <div id="menuHead">
        <a href="about.php">
            <div style="margin-right: 5%">О нас</div>
        </a>
        <a href="feedback.php">
            <div>Обратная связь</div>
        </a>
    </div>
    <div id="regAuth">
        
        <a href="reg.php">Регистрация</a> | 
                <?php
                //если пользователь авторизовался вводим его имя если нет вставляем ссылочку для авторизации
                 if ($_SESSION['login'] != '') {
                    $login = $_SESSION['login'];
                    echo $login."<a href='sait_1/../functions/exit.php'> Выход</a>";
                    } else {
                    echo '<a href="auth.php">Авторизация</a>';
                    }
                ?>
    </div>
</header>
