
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
<nav>

<?php 
    if(!App::$auth->isAuth())
    {
        echo '<a id="about_button" href="/home">Главная</a>';
        echo '<a id="admin_button" href="/admin">Войти</a>';
    }
    else 
    {
        echo '<a id="about_button" href="/admin/cab">Главная</a>';
        echo '<a id="admin_button" href="/admin/logout">Выйти</a>';
    }
    ?>

</nav>
</header>
<div class="container">
<?= $body ?>
        </div>
    </body>
</html>