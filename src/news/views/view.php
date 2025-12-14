<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/view.css">
</head>
<body>

<header>
    <a href="/">Главная</a> |
    <a href="/newslist">Новости</a> |
    <a href="/achievements">Достижения</a> |
    <a href="#">Для Участников</a> |
    <a href="#">Для Новичков</a> |
    <a href="#">Контакты</a> |
    <a href="/media">Медиа</a>
</header>

<div class="side-button" onclick="location.href='/<?= $type ?>'">
    <a>&lt;Назад</a>
</div>

<div class="container">
    <article>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <pre><?= htmlspecialchars($article['text_md']) ?></pre>
    </article>
</div>

</body>
</html>
