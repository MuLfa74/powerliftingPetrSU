<?php
namespace App\News;

use PDO;

class NewsRepository
{
    private PDO $db;
    private const PER_PAGE = 10;

    /**
     * Конструктор репозитория новостей.
     *
     * @param PDO $db Экземпляр PDO для выполнения запросов к базе данных.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Возвращает статьи указанного типа для страницы.
     *
     * @param string $type Тип статей для выборки.
     * @param int $page Номер страницы (1-based).
     * @return array Массив статей для указанной страницы.
     */
    public function getByType(string $type, int $page): array
    {
        $offset = ($page - 1) * self::PER_PAGE;

        $stmt = $this->db->prepare(
            "SELECT id, title, text_md, created_at
             FROM articles
             WHERE type = :type
             ORDER BY created_at DESC
             LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':limit', self::PER_PAGE, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Возвращает количество статей заданного типа.
     *
     * @param string $type Тип статей.
     * @return int Общее число статей данного типа.
     */
    public function countByType(string $type): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM articles WHERE type = :type"
        );
        $stmt->execute(['type' => $type]);

        return (int)$stmt->fetchColumn();
    }

    /**
     * Возвращает одну статью по идентификатору.
     *
     * @param int $id Идентификатор статьи.
     * @return array|null Ассоциативный массив статьи или null если не найдено.
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM articles WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);

        $article = $stmt->fetch();
        return $article ?: null;
    }
}
