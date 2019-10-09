
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Задачник</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="/css/btest.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

</head>
<body>
<header>
<nav>
<a id="about_button" href="/home">Главная</a>
<?php 
    if(!App::$auth->isAuth())
        echo '<a id="admin_button" href="/admin">Войти</a>';
    else 
        echo '<a id="admin_button" href="/admin/logout">Выйти</a>';
    ?>

</nav>
</header>
<div class="container">
<?= $body ?>
        </div>
    </body>
</html>