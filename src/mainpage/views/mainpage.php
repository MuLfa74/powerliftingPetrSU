<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/achivements.css">
</head>
<body>

<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="grid">
    <!-- Верхняя полоса → Новости -->
    <div class="big-box">
        <h2>Новости</h2>
        <div class="news-list">
            <?php if (empty($news)): ?>
                <p>Новостей пока нет</p>
            <?php else: ?>
                <?php foreach ($news as $article): ?>
                    <div class="news-item">
                        <h3><?= htmlspecialchars($article['title']) ?></h3>
                        <p><?= htmlspecialchars($article['preview']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Нижняя строка -->
    <div class="small-box">
        <h2> Интервью </h2>
        <div class="news-list">
            <?php if (empty($interview)): ?>
                <p>Интервью пока нет</p>
            <?php else: ?>
                <?php foreach ($intreview as $article): ?>
                    <div class="news-item">
                        <h3><?= htmlspecialchars($article['title']) ?></h3>
                        <p><?= htmlspecialchars($article['preview']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="small-box">
        <section class="records-block" style="max-height: 100%">
            <table class="records-table">
                <caption>Наши рекорды</caption>
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Возраст</th>
                        <th>Категория</th>
                        <th>Результат (КГ)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($maxRecords)): ?>
                        <tr><td colspan="4">Нет данных</td></tr>
                    <?php else: ?>
                        <?php foreach (['benchpress', 'deadlift', 'squat'] as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($maxRecords[$category]['name']) ?></td>
                                <td><?= htmlspecialchars($maxRecords[$category]['age']) ?></td>
                                <td><?= htmlspecialchars($category) ?></td>
                                <td><?= htmlspecialchars($maxRecords[$category]['record_value']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
    <div class="small-box">Категория 3 (В разработке)</div>

</div>

</body>
</html>
