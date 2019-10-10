
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Задачник</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="/css/btest.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous">
</script>

</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<?php 
    if(!App::$auth->isAuth())
    {
        echo '<li class="nav-item active"><a id="about_button" class="nav-link" href="/home">Главная</a></li>';
        echo '<li><a id="admin_button" class="nav-link" href="/admin">Войти</a></li>';
    }
    else 
    {
        echo '<li class="nav-item active"><a id="about_button" class="nav-link" href="/admin/cab">Главная</a></li>';
        echo '<li><a id="admin_button" class="nav-link" href="/admin/logout">Выйти</a></li>';
    }
    ?>
</ul>
</div>
</nav>
</header>
<div class="container">
<?= $body ?>
        </div>
    </body>
</html>