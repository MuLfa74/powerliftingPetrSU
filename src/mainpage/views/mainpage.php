<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/static/style.css">
</head>
<body>

<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="grid">
    <!-- Верхняя полоса → Новости -->
    <div class="news-big">
        <h2>Новости</h2>
        <div class="news-list">
            <?php if (empty($articles)): ?>
                <p>Новостей пока нет</p>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                    <div class="news-item">
                        <h3><?= htmlspecialchars($article['title']) ?></h3>
                        <p><?= htmlspecialchars($article['preview']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Нижняя строка -->
    <div class="block">Категория 1 (В разработке)</div>
    <div class="block">Категория 2 (В разработке)</div>
    <div class="block">Категория 3 (В разработке)</div>

</div>

</body>
</html>
