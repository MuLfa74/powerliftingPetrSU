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
        $news = $this->repo->getLatestArticles(3);
        $interview = $this->repo->getLatestArticles(1, 'interview');
        $maxRecords = $this->repo->getMaxAchivements(['benchpress', 'deadlift', 'squat']);

        // формируем краткое описание (первые N символов)
        foreach ($news as &$newsArticle) {
            $newsArticle['preview'] = mb_substr(strip_tags($newsArticle['text_md']), 0, 150) . '...';
        }

        foreach ($interview as &$interviewArticle) {
            $interviewArticle['preview'] = mb_substr(strip_tags($interviewArticle['text_md']), 0, 150) . '...';
        }

        unset($interviewArticle); unset($newsArticle);

        require __DIR__ . '/views/mainpage.php';
    }
}
