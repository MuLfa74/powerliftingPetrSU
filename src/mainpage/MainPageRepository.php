<?php

namespace App\MainPage;

use PDO;

class MainPageRepository
{
    private $db;

    /**
     * Конструктор репозитория.
     *
     * @param mixed $db Экземпляр подключения к БД (PDO) или null.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Возвращает последние статьи.
     *
     * @param int $limit Количество статей для выборки.
     * @return array Массив статей (каждая запись — ассоциативный массив).
     */
    public function getLatestArticles(int $limit = 3): array
    {
        if (!$this->db) {
            return [];
        }

        $stmt = $this->db->prepare(
            "SELECT id, title, text_md
             FROM articles
             ORDER BY created_at DESC
             LIMIT :limit"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
