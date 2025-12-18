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

<?php
$titles = [
    'deadlift' => 'Становая тяга',
    'benchpress' => 'Жим лежа',
    'squat' => 'Присед'
];
?>

<div class="item-list">
    <h1> Рекорды сборной </h1>
    <div class="achivements">
        <?php foreach($types as $category): ?>
            <div class="card">
                <h2><?= htmlspecialchars($titles[$category] ?? $category) ?></h2>
                <a class="record-value"><?= htmlspecialchars($maxRecords[$category]['record_value']) ?></a>
                <a>КГ</a>
                <nav>
                    <ul class="card-details">
                        <li><a><?= htmlspecialchars($maxRecords[$category]['name']) ?></a></li>
                        <li><a><?= htmlspecialchars($maxRecords[$category]['age']) ?> лет</a></li>
                    </ul>
                </nav>
            </div>
        <?php endforeach; ?>
    </div>

    <h1 style="margin-top:1em"> Таблицы рекордов </h1>

    <div class="records-container">
        <?php foreach ($tablesData as $category => $rows): ?>
            <?php
            // Защитная и локальная копия, сортировка по value (убывание)
            $rows = is_array($rows) ? $rows : [];
            usort($rows, function($a, $b){
                return $b['value'] <=> $a['value'];
            });
            ?>
            <section class="records-block" id="<?= htmlspecialchars($category) ?>">
                <table class="records-table">
                    <caption><?= htmlspecialchars($titles[$category] ?? $category) ?></caption>
                    <thead>
                        <tr>
                            <th>Место</th>
                            <th>Имя</th>
                            <th>Возраст</th>
                            <th>Результат (КГ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rows)): ?>
                            <tr><td colspan="4">Нет данных</td></tr>
                        <?php else: ?>
                            <?php $rank = 1; ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?= $rank++ ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['age']) ?></td>
                                    <td><?= htmlspecialchars($row['value']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>