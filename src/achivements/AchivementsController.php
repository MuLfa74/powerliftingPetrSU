<?php

namespace App\Achivements;

class AchivementsController{
    private AchivementsRepository $repo;

    /**
     * Конструктор контроллера достижений.
     *
     * @param mixed $db Экземпляр подключения к БД (PDO) или null.
     */
    public function __construct($db)
    {
        $this->repo = new AchivementsRepository($db);
    }

    /**
     * Показывает страницу достижений.
     *
     * Получает максимальные рекорды и таблицы достижений, затем подключает view.
     *
     * @return void
     */
    public function index(): void
    {   
        $types = ['deadlift', 'benchpress', 'squat'];
        $maxRecords = $this->repo->getMaxAchivements($types);
        $tablesData = $this->repo->getAllAchievementsByCategory();
        
        require __DIR__ . '/views/achivements.php';
    }
}