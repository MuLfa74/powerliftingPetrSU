<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $type === 'news' ? 'Новости' : 'Интервью' ?></title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel='stylesheet' href='/static/list.css'>
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

<div class="side-button">
<a>˄Наверх<a>
</div>
<div class="item-list">
    <h1><?= $type === 'news' ? 'Новости' : 'Интервью' ?></h1>

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
    <?php if ($pages > 1): ?>
    <nav>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="<?= $type?>/page/<?= $i ?>"></a>
        <?php endfor; ?>
    </nav>
    <?php endif; ?>
</div>

</body>
</html>
