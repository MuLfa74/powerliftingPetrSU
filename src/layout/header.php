<header>
    <h1> Сборная по пауэрлифтингу ПетрГУ </h1>
    <nav>
    <ol class="header-ref">
        <li><a href="/">Главная</a></li>|
        <div class="dropdown">
            <li><a>Новости</a></li>
            <div class="dropdown-content">
                <a href="/newslist">Лента новостей</a>
                <a href="/interviewlist">Интервью</a>
            </div>
        </div>|
        <li><a href="/achivements">Достижения</a></li>|
        <div class="dropdown">
            <li><a>Для Участников</a></li>
            <div class="dropdown-content">
                <?php if($_SESSION['role'] === null): ?> <a href="/login">Вход</a> <?php endif; ?>
                <?php if($_SESSION['role'] !== null): ?> <a href="/logout">Выход</a> <?php endif; ?>
                <?php if($_SESSION['role'] !== null): ?> <a href="/profile">Профиль</a> <?php endif; ?>
                <?php if($_SESSION['role'] === 'admin'): ?> <a href="/admin">Тренерская</a> <?php endif; ?>
            </div>
        </div>|
        <li><a href="/for_newbies">Для Новичков</a></li>|
        <li><a href="/contact">Контакты</a></li>|
        <li><a href="/media">Медиа</a></li>
    </ol>
    </nav>
</header>