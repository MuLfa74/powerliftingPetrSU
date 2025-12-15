<?php

namespace App\Achivements;

use PDO;

class AchivementsRepository{
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