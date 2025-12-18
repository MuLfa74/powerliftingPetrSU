<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/list.css">
    <link rel="stylesheet" href="/static/login.css">
</head>
<body>
<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class='item-list'>
<h1>Вход</h1>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <input type="email" name="email" required placeholder="Email"><br>
    <input type="password" name="password" required placeholder="Пароль"><br>
    <button type="submit">Войти</button>
</form>

</div>

</body>
</html>
