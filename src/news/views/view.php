<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel='stylesheet' href='/static/list.css'>
    <style>
        .item-list article{
            margin-bottom: 10px;
            overflow-wrap: break-word;
        }
        .item-list article:hover{ 
            background: white;
        }
    </style>
</head>
<body>

<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="side-button" onclick="location.href='/<?= $type ?>'">
    <a>&lt;Назад</a>
</div>

<div class="item-list">
    <article>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <p><?= htmlspecialchars($article['text_md']) ?></p>
    </article>
</div>

</body>
</html>
