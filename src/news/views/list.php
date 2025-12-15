<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $type === 'news' ? 'Новости' : 'Интервью' ?></title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel='stylesheet' href='/static/list.css'>
</head>
<body>

<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="side-button" onclick="window.scrollTo({top: 0, left: 0, behavior: 'smooth'})">
    <a>˄Наверх</a>
</div>

<div class="item-list">
    <h1><?= $type === 'news' ? 'Лента новостей' : 'Интервью' ?></h1>

    <?php if (empty($articles)): ?>
        <p>Материалов нет</p>
    <?php else: ?>
        <?php foreach ($articles as $a): ?>
            <article onclick="location.href='/<?= $type?>/<?= $a['id'] ?>'">
                <h2><?= htmlspecialchars($a['title']) ?></h2>
                <p><?= htmlspecialchars($a['preview']) ?></p>
            </article>
            <hr></hr>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Пагинация -->
    <nav>
    <ol class="pagination">
    <?php if ($pages > 1): ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li onclick="location.href='/<?= $type ?>list/page/<?= $i ?>'"><a><?= $i ?></a>
        </li>
        <?php endfor; ?>
    <?php endif; ?>
    </ol>
    </nav>
</div>

</body>
</html>
