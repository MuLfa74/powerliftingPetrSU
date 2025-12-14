<?php

namespace App\MainPage;

class MainPageController
{
    private MainPageRepository $repo;
 
    /**
     * Конструктор контроллера.
     *
     * @param mixed $db Экземпляр подключения к БД (PDO) или null.
     */
    public function __construct($db)
    {
        $this->repo = new MainPageRepository($db);
    }

    /**
     * Отображает главную страницу.
     *
     * Получает последние статьи из репозитория, формирует краткий превью
     * и подключает шаблон представления `views/mainpage.php`.
     *
     * @return void
     */
    public function index(): void
    {
        $articles = $this->repo->getLatestArticles(3);

        // формируем краткое описание (первые N символов)
        foreach ($articles as &$article) {
            $article['preview'] = mb_substr(strip_tags($article['text_md']), 0, 150) . '...';
        }

        unset($article);

        require __DIR__ . '/views/mainpage.php';
    }
}
