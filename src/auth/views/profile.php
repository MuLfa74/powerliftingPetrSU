<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/list.css">
    <link rel="stylesheet" href="/static/login.css">
</head>
<?php
$fields = [
    'name' => 'Имя:',
    'email' => 'Почта',
    'age' => 'Возраст',
    'role' => 'Роль пользователя',
    'records' => [
        'deadlift' => 'Становая тяга',
        'benchpress' => 'Жим лежа',
        'squat' => 'Присед'
    ]
]
?>
<body>
<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class='item-list'>
    <h1> Профиль пользователя </h1>
    <a>Имя:</a> <a><?= $profile['name'] ?></a> </br>
    <a>Почта:</a> <a><?= $profile['email'] ?></a> </br>
    <a>Возраст:</a> <a><?= $profile['age'] ?></a> </br>
    <a>Роль пользователя:</a> <a><?= $profile['role'] ?></a> </br>
    <div class='mini-table'> 
        <a>Становая тяга:</a> <a><?= $profile['records']['deadlift'] ?></a> </br>
        <a>Жим лежа:</a> <a><?= $profile['records']['benchpress'] ?></a> </br>
        <a>Присед:</a> <a><?= $profile['records']['squat'] ?></a> </br>
    </div>
</div>

</body>
</html>