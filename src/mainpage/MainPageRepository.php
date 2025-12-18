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
    public function getLatestArticles(int $limit = 3, string $type = 'news'): array
    {
        if (!$this->db) {
            return [];
        }

        $stmt = $this->db->prepare(
            "SELECT id, title, text_md
             FROM articles
             WHERE type = :type
             ORDER BY created_at DESC
             LIMIT :limit"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':type', $type, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает максимальные значения по заданным типам достижений.
     *
     * @param string[] $types Список типов достижений.
     * @return array Ассоциативный массив типа => запись (name, age, record_value).
     */
    public function getMaxAchivements(array $types): array
    {   
        $records = [];

        foreach ($types as $type) {
            $stmt = $this->db->query("
                SELECT u.name, u.age, a.$type AS record_value
                FROM achievements a
                JOIN users u ON u.id = a.user_id
                ORDER BY a.$type DESC, u.name ASC
                LIMIT 1
            ");
            $records[$type] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $records;
    }
}
