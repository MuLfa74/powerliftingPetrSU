<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Достижения и рекорды</title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/achivements.css">
    <link rel='stylesheet' href='/static/list.css'>
</head>
<body>
<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="side-button" onclick="window.scrollTo({top: 0, left: 0, behavior: 'smooth'})">
    <a>˄Наверх</a>
</div>

<div class="item-list">
    <h1> Рекорды сборной </h1>
    <div class="achivements">
        <?php foreach($types as $type): ?>
            <div class="card">
                <h2><?= $type ?></h2>
                <a class="record-value"><?= htmlspecialchars($maxRecords[$type]['record_value']) ?></a>
                <a>КГ</a>
                <nav>
                    <ul class="card-details">
                        <li><a><?= htmlspecialchars($maxRecords[$type]['name']) ?></a></li>
                        <li><a><?= htmlspecialchars($maxRecords[$type]['age']) ?> лет</a></li>
                    </ul>
                </nav>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="record-tables">

    </div>
</div>

</body>
</html>