<?php

namespace App\News;

class NewsController
{
    private NewsRepository $repo;

    /**
     * Конструктор контроллера новостей.
     *
     * @param mixed $db Экземпляр подключения к БД (PDO) или null.
     */
    public function __construct($db)
    {
        $this->repo = new NewsRepository($db);
    }

    /**
     * Показывает список новостей по типу.
     *
     * Берет номер страницы из GET-параметра `page`, получает список и
     * общее число статей из репозитория, формирует превью и подключает
     * шаблон `views/list.php`.
     *
     * @param string $type Тип новостей.
     * @return void
     */
    public function list(string $type): void
    {
        $page = max(1, (int)($_GET['page'] ?? 1));

        $articles = $this->repo->getByType($type, $page);
        $total = $this->repo->countByType($type);
        $pages = (int)ceil($total / 10);

        foreach ($articles as &$article) {
            $article['preview'] = mb_substr(
                strip_tags($article['text_md']),
                0,
                200
            ) . '...';
        }
        unset($article);

        require __DIR__ . '/views/list.php';
    }

    /**
     * Отображает полную статью по `id` из GET-параметра.
     *
     * Если `id` отсутствует или статья не найдена — возвращает 404.
     *
     * @return void
     */
    public function view(string $type): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            http_response_code(404);
            echo 'Статья не найдена';
            return;
        }

        $article = $this->repo->getById($id);
        if (!$article) {
            http_response_code(404);
            echo 'Статья не найдена';
            return;
        }

        require __DIR__ . '/views/view.php';
    }
}
