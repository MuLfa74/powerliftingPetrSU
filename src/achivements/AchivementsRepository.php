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

    /**
     * Возвращает максимальные значения по заданным типам достижений.
     *
     * @param string[] $types Список типов достижений (напр., 'deadlift', 'benchpress', 'squat').
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

    /**
     * Возвращает все записи достижений, сгруппированные по категориям.
     *
     * @return array Массив с ключами 'deadlift', 'benchpress', 'squat', содержащими списки записей.
     */
    public function getAllAchievementsByCategory(): array
    {
        $sql = "
            SELECT
                u.id AS user_id,
                u.name,
                u.age,
                a.deadlift,
                a.benchpress,
                a.squat
            FROM achievements a
            JOIN users u ON u.id = a.user_id
        ";

        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [
            'deadlift'    => [],
            'benchpress' => [],
            'squat'      => []
        ];

        foreach ($rows as $row) {
            if ($row['deadlift'] !== null) {
                $result['deadlift'][] = [
                    'user_id' => $row['user_id'],
                    'name'    => $row['name'],
                    'age'     => $row['age'],
                    'value'   => $row['deadlift']
                ];
            }

            if ($row['benchpress'] !== null) {
                $result['benchpress'][] = [
                    'user_id' => $row['user_id'],
                    'name'    => $row['name'],
                    'age'     => $row['age'],
                    'value'   => $row['benchpress']
                ];
            }

            if ($row['squat'] !== null) {
                $result['squat'][] = [
                    'user_id' => $row['user_id'],
                    'name'    => $row['name'],
                    'age'     => $row['age'],
                    'value'   => $row['squat']
                ];
            }
        }

        return $result;
    }
}