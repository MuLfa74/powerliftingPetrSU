<?php
namespace App\Auth;

use PDO;

class AuthRepository
{   
    private $db;

    /**
     * Конструктор репозитория аутентификации.
     *
     * @param PDO|mixed $db Экземпляр PDO для доступа к базе данных.
     */
    public function __construct($db){
        $this->db = $db;
    }

    /**
     * Находит пользователя по email.
     *
     * @param string $email Email пользователя.
     * @return array|null Ассоциативный массив с полями (id, password_hash, role) или null если не найдено.
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT id, password_hash, role
             FROM users
             WHERE email = :email
             LIMIT 1"
        );

        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Получает профиль и рекорды пользователя по идентификатору.
     *
     * @param int $userId Идентификатор пользователя.
     * @return array|null Ассоциативный массив профиля или null если не найдено.
     */
    public function getProfileByUserId(int $userId): ?array
    {   
        $stmt = $this->db->prepare("
            SELECT
                u.email,
                u.name,
                u.age,
                u.role,
                a.deadlift,
                a.benchpress,
                a.squat
            FROM users u
            LEFT JOIN achievements a ON a.user_id = u.id
            WHERE u.id = :user_id
            LIMIT 1
        ");

        $stmt->execute(['user_id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $profile = [
            'name'  => $row['name'] ?? 'N\A',
            'email' => $row['email'] ?? 'N\A',
            'age'   => $row['age'] ?? 'N\A',
            'role'  => $row['role'] ?? 'N\A',
            'records' => [
                'deadlift'   => $row['deadlift']   ?? 'N\A',
                'benchpress' => $row['benchpress'] ?? 'N\A',
                'squat'      => $row['squat']      ?? 'N\A',
            ],
        ];

        return $profile ?: null;
    }   

}
